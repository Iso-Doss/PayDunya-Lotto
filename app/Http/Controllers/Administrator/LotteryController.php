<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\Lottery\LotteryFilterRequest;
use App\Http\Requests\Administrator\Lottery\LotteryFormRequest;
use App\Jobs\DrawJob;
use App\Models\Job;
use App\Models\Lottery;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class LotteryController extends Controller
{

    /**
     * Lottery controller construct.
     */
    public function __construct()
    {
        parent::__construct('administrator');
    }

    /**
     * Lottery list controller.
     *
     * @param LotteryFilterRequest $request The lottery filter request.
     * @return View The package type list page view.
     */
    public function index(LotteryFilterRequest $request): View
    {
        $lotteryFilterData = $request->validated();

        $lotteries = Lottery::when($lotteryFilterData['name'] ?? '', function ($query) use ($lotteryFilterData) {
            return $query->where('name', 'LIKE', '%' . $lotteryFilterData['name'] . '%');
        })
            ->when($lotteryFilterData['date'] ?? '', function ($query) use ($lotteryFilterData) {
                return $query->where('date', '=', $lotteryFilterData['date']);
            })
            ->when($lotteryFilterData['jackpot'] ?? '', function ($query) use ($lotteryFilterData) {
                return $query->where('jackpot', '=', $lotteryFilterData['jackpot']);
            })
            ->when($lotteryFilterData['status_id'] ?? '', function ($query) use ($lotteryFilterData) {
                return $query->where('status_id', '=', $lotteryFilterData['status_id']);
            })
            ->orderBy('id', 'desc')
            ->paginate(10);


        $users = User::where('profile', '=', 'customer')->whereNotNull('verified_at')->whereNotNull('activated_at')->get();
        $statuses = Status::where('entity', '=', 'LOTTERY')->whereNotNull('activated_at')->get();

        return view($this->profile . '.dashboard.lottery.index', ['lotteries' => $lotteries, 'input' => $request, 'users' => $users, 'statuses' => $statuses]);
    }

    /**
     * Create lottery form controller.
     *
     * @return View The create lottery form view.
     */
    public function createForm(): View
    {
        $lottery = new Lottery();
        return view($this->profile . '.dashboard.lottery.form', ['lottery' => $lottery]);
    }

    /**
     * Create lottery traitement controller.
     *
     * @param LotteryFormRequest $request The lottery form request.
     * @return RedirectResponse The redirect response.
     */
    public function create(LotteryFormRequest $request): RedirectResponse
    {
        $lotteryData = $request->validated();

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

        if (!empty($lotteryData['image'])) {
            $upload = $this->uploadImage($request, 'lottery');
            $lotteryData['image'] = (!empty($upload)) ? $upload : null;
        } else {
            $lotteryData['image'] = null;
        }

        if (empty($lotteryData['status_id'])) {
            $lotteryStatusWaitingDraw = Status::whereCode('WAITING_DRAW')->first();
            $lotteryData['status_id'] = $lotteryStatusWaitingDraw?->id;
        }

        $lottery = Lottery::create($lotteryData);

        $addSecond = strtotime($lotteryData['date']) - strtotime(now());
        DrawJob::dispatch($lottery, [])->delay(now()->addSecond(10));
        //DrawJob::dispatch($lottery, [])->delay(now()->addSecond($addSecond));

        return redirect()->route($this->profile . '.lottery.index')->with(['success' => __('La loterie :lottery a été enregistrée avec succès.', ['lottery' => $lottery->name])]);
    }

    /**
     * Update lottery form controller.
     *
     * @return View The update lottery form view.
     */
    public function updateForm(Lottery $lottery): View
    {
        return view($this->profile . '.dashboard.lottery.form', ['lottery' => $lottery]);
    }

    /**
     * Update lottery traitement controller.
     *
     * @param LotteryFormRequest $request The lottery form request.
     * @param Lottery $lottery The lottery.
     * @return RedirectResponse The redirect response.
     */
    public function update(LotteryFormRequest $request, Lottery $lottery): RedirectResponse
    {
        $lotteryStatusWaitingDraw = Status::whereCode('WAITING_DRAW')->first();
        $lotteryData = $request->validated();

        if ($lotteryStatusWaitingDraw?->id != $lottery->status_id) {
            return back()->with(['error' => 'Impossible de mettre a jour cette loterie, le tirage a déja eu lieu.'])->withInput($lotteryData);;
        }


        if ('Tue' != date('D', strtotime($lotteryData['date'])) && 'Thu' != date('D', strtotime($lotteryData['date']))) {
            return back()->withErrors(['date' => 'Le champ date de la loterie doit être une date dont le jour est soit un Mardi soit un Jeudi.'])->with(['error' => 'Le champ date est incorrect. Veuillez réessayer.'])->withInput($lotteryData);;
        }

        if (strtotime(now()) > strtotime($lotteryData['date'])) {
            return back()->withErrors(['date' => 'Le champ date de la loterie doit être supérieur a la date d\'aujourd\'hui.'])->with(['error' => 'Le champ date est incorrect. Veuillez réessayer.'])->withInput($lotteryData);;
        }

        $alreadyLottery = Lottery::where('date', '=', $lotteryData['date'])->where('id', '<>', $lottery->id)->first();
        if ($alreadyLottery) {
            return back()->withErrors(['date' => 'Le champ date de la loterie contient une valeur qui est deja prit par une autre loterie.'])->with(['error' => 'Le champ date est incorrect. Veuillez réessayer.', 'input' => $lotteryData])->withInput($lotteryData);;
        }

        if (!empty($lotteryData['image'])) {
            if (!empty($lottery->image)) {
                Storage::disk('public')->delete($lottery->image);
            }
            $upload = $this->uploadImage($request, 'lottery');
            $lotteryData['image'] = (!empty($upload)) ? $upload : null;
        } else {
            $lotteryData['image'] = null;
        }

        $lottery->update($lotteryData);

        // Suppression de la précédente job.
        $drawJobsRemaining = Job::where('payload', 'like', '%DrawJob%')->get();
        foreach ($drawJobsRemaining as $job) {
            $payload = json_decode($job->payload, true);
            $jobDraw = unserialize($payload['data']['command']);
            if ($jobDraw->lottery->id == $lottery->id) {
                $job->delete();
            }
        }

        $addSecond = strtotime($lotteryData['date']) - strtotime(now());
        DrawJob::dispatch($lottery, [])->delay(now()->addSecond(10));
        //DrawJob::dispatch($lottery, [])->delay(now()->addSecond($addSecond));

        return redirect()->route($this->profile . '.lottery.index')->with(['success' => __('La loterie :lottery a été modifiée avec succès.', ['lottery' => $lottery->name])]);
    }

    /**
     * Enable or disable lottery traitement controller.
     *
     * @param Lottery $lottery The lottery.
     * @param string $new_status The lottery new status.
     * @return RedirectResponse The redirect response.
     */
    public function enableDisable(Lottery $lottery, string $new_status): RedirectResponse
    {

        if ($new_status != 'disable' && $new_status != 'enable') {
            return back()->withErrors(['Une action inattendue bloque le processus.']);
        }

        $old_lottery = (is_null($lottery->activated_at)) ? 'disable' : 'enable';

        if ($new_status != $old_lottery && 'disable' == $new_status) {
            $lottery->activated_at = NULL;
        } else if ($new_status != $old_lottery && 'enable' == $new_status) {
            $lottery->activated_at = now();
        }
        $lottery->update();

        $toDo = ($new_status == 'disable') ? 'désactivée' : 'activée';

        return redirect()->route($this->profile . '.lottery.index')->with(['success' => __('La loterie :lottery a été :to-do avec succès.', ['lottery' => $lottery->name, 'to-do' => $toDo])]);
    }

    /**
     * Delete lottery traitement controller.
     *
     * @param Lottery $lottery The lottery.
     * @return RedirectResponse The redirect response.
     */
    public function delete(Lottery $lottery): RedirectResponse
    {
        $lottery->delete();
        return redirect()->route($this->profile . '.lottery.index')->with(['success' => __('La loterie :lottery a été supprimée avec succès.', ['lottery' => $lottery->name])]);
    }

}
