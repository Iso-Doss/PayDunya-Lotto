<?php

namespace App\Jobs;

use App\Models\Lottery;
use App\Models\Status;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Notifications\UserWinnerLotteryNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DrawJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Lottery $lottery, array $data = [])
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $lottery = Lottery::find($this->lottery->id);
        if ($lottery->status->code == 'WAITING_DRAW') {
            // Effectuer le tirage.
            $numbersDrawnArray = $this->drawing();
            $numbersDrawnArray = [1, 2, 3, 4, 5, 6, 7];
            $lottery->numbers_drawn = $numbersDrawnString = implode(", ", $numbersDrawnArray);
            // Mettre à jour le status de la loterie.
            $lotteryStatusWaitingDraw = Status::whereCode('DRAWING')->whereEntity('LOTTERY')->first();
            if ($lotteryStatusWaitingDraw?->id) {
                $lottery->status_id = $lotteryStatusWaitingDraw?->id;
                $lottery->statuses()->attach([$lottery->status_id]);
            }
            $lottery->update();

            // Récupérer la lise des utilisateurs qui ont participés à cette loterie.
            // Parcourir la liste afin de determiner le ou les gagnants.
            $users_winner = [];

            if ($lottery->users) {
                foreach ($lottery->users as $user) {
                    $lotteryUserWithNumbersDrawn = $user->lotteries()->where('lottery_id', '=', $lottery->id)->first();
                    var_dump($lotteryUserWithNumbersDrawn->pivot->numbers_drawn, $numbersDrawnString );
                    if ($lotteryUserWithNumbersDrawn->pivot->numbers_drawn == $numbersDrawnString) {
                        $users_winner[] = $user;
                        $user->lotteries()->updateExistingPivot($lottery->id, ['status_id' => Status::whereCode('WINNER')->whereEntity('LOTTERY_USER')->first()?->id]);
                    } else {
                        $user->lotteries()->updateExistingPivot($lottery->id, ['status_id' => Status::whereCode('LOSING')->whereEntity('LOTTERY_USER')->first()?->id]);
                    }
                }
            }
            // Déterminer la cagnotte de ou des gagnants.
            $userJackpot = $lottery->jackpot;
            $nextLotteryJackpot = 20000000;
            $lotteryNewStatus = null;
            if (sizeof($users_winner) <= 0) {
                $userJackpot = 0;
                $nextLotteryJackpot = $lottery->jackpot + 5000000;
                $lotteryNewStatus = Status::whereCode('NO_WINNER')->whereEntity('LOTTERY')->first()?->id;
            } elseif (sizeof($users_winner) == 1) {
                $lotteryNewStatus = Status::whereCode('A_WINNER')->whereEntity('LOTTERY')->first()?->id;
            } elseif (sizeof($users_winner) > 1) {
                $userJackpot = $lottery->jackpot / sizeof($users_winner);
                $lotteryNewStatus = Status::whereCode('MULTIPLE_WINNER')->whereEntity('LOTTERY')->first()?->id;
            }
            $lottery->status_id = $lotteryNewStatus;
            $lottery->statuses()->attach([$lotteryNewStatus]);
            $lottery->update();

            foreach ($users_winner as $user_winner) {
                $user_winner->lotteries()->updateExistingPivot($lottery->id, ['amount' => $userJackpot]);
                $transaction = Transaction::create([
                    'user_id' => $user_winner->id,
                    'lottery_id' => $lottery->id,
                    'transaction_type_id' => TransactionType::whereCode('JACKPOT_LOTTERY')->first()?->id,
                    'ticket_id' => null,
                    'status_id' => Status::whereCode('SUCCESS')->first()?->id, // Status::whereCode('FAILED')->first()?->id,
                    'amount' => $userJackpot
                ]);
                // Envoyer un mail à tous les utilisateurs qui ont gagné à cette loterie.
                $user_winner->notify(new UserWinnerLotteryNotification($user_winner, $lottery, [
                    'title' => 'Félicitation vous avez gagner une cagnotte de loterie',
                    'message' => 'Félicitation vous avez gagner une cagnotte de loterie',
                    'view' => 'mails.lottery.index',
                ]));
            }
            // Programmer le prochain tirage.
            $nextLotteryDate = '';
            if ('Tue' == date('D', strtotime($lottery->date))) {
                $nextLotteryDate = date('Y-m-d', strtotime($lottery->date . " +2 days"));
            } elseif ('Thu' == date('D', strtotime($lottery->date))) {
                $nextLotteryDate = date('Y-m-d', strtotime($lottery->date . " +5 days"));
            }
            $alreadyLottery = Lottery::where('date', '=', $nextLotteryDate)->first();
            if ($alreadyLottery) {
                $alreadyLottery->jackpot = $nextLotteryJackpot;
                $alreadyLottery->update();
            } else {
                $this->createLottery([
                    'name' => 'Loterie du ' . $nextLotteryDate,
                    'date' => $nextLotteryDate,
                    'jackpot' => $nextLotteryJackpot,
                    //'status_id' => Status::whereCode('WAITING_DRAW')->whereEntity('LOTTERY')->first()
                ]);
            }

        }
    }

    /**
     * Get seven distinct number.
     *
     * @return array $numbers_drawn The numbers drawn.
     */
    public function drawing(): array
    {
        $numbers_drawn = [];
        $n = range(1, 50);
        shuffle($n);
        for ($x = 0; $x < 7; $x++) {
            $numbers_drawn[] = $n[$x];
        }
        return $numbers_drawn;
    }

    public function createLottery(array $lotteryData)
    {
        if ('Tue' != date('D', strtotime($lotteryData['date'])) && 'Thu' != date('D', strtotime($lotteryData['date']))) {
            return back()->withErrors(['date' => 'Le champ date de la loterie doit être une date dont le jour est soit un Mardi soit un Jeudi.'])->with(['error' => 'Le champ date est incorrect. Veuillez réessayer.']);
        }

        if (strtotime(now()) > strtotime($lotteryData['date'])) {
            return back()->withErrors(['date' => 'Le champ date de la loterie doit être supérieur a la date d\'aujourd\'hui.'])->with(['error' => 'Le champ date est incorrect. Veuillez réessayer.']);
        }

        $alreadyLottery = Lottery::where('date', '=', $lotteryData['date'])->first();
        if ($alreadyLottery) {
            return back()->withErrors(['date' => 'Le champ date de la loterie contient une valeur qui est deja prit par une autre loterie.'])->with(['error' => 'Le champ date est incorrect. Veuillez réessayer.', 'input' => $lotteryData]);
        }

        //if (!empty($lotteryData['image'])) {
        //    $upload = $this->uploadImage($request, 'lottery');
        //    $lotteryData['image'] = (!empty($upload)) ? $upload : null;
        //} else {
        //    $lotteryData['image'] = null;
        //}

        if (empty($lotteryData['status_id'])) {
            $lotteryStatusWaitingDraw = Status::whereCode('WAITING_DRAW')->first();
            $lotteryData['status_id'] = $lotteryStatusWaitingDraw?->id;
        }

        $lottery = Lottery::create($lotteryData);
        $lottery->statuses()->sync([$lotteryData['status_id']]);

        $addSecond = strtotime($lotteryData['date']) - strtotime(now());
        //DrawJob::dispatch($lottery, [])->delay(now()->addSecond(60));
        DrawJob::dispatch($lottery, [])->delay(now()->addSecond($addSecond));
    }
}
