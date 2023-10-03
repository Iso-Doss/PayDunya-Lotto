<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\Lottery\LotteryFilterRequest;
use App\Http\Requests\BuyTicketRequest;
use App\Models\Lottery;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Paydunya\Checkout\Store;
use Paydunya\Setup;

class LotteryController extends Controller
{

    /**
     * Lottery controller construct.
     */
    public function __construct()
    {
        parent::__construct();
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

        $lotteries = auth('customer')->user()->lotteries()->when($lotteryFilterData['name'] ?? '', function ($query) use ($lotteryFilterData) {
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
     * Buy ticket lottery form controller.
     *
     * @return View The create country form package view.
     */
    public function buyTicketForm(): View
    {
        $lotteries = Lottery::whereNotNull('activated_at')->get();
        $tickets = Ticket::whereNotNull('activated_at')->get();
        return view($this->profile . '.dashboard.lottery.buy-ticket', ['lotteries' => $lotteries, 'tickets' => $tickets,]);
    }

    /**
     * Buy ticket lottery traitement controller.
     *
     * @param BuyTicketRequest $request The lottery form request.
     * @return RedirectResponse The redirect response.
     */
    public function buyTicket(BuyTicketRequest $request): RedirectResponse
    {
        $buyTicketData = $request->validated();
        $numbersDrawn = array_filter(explode(',', $buyTicketData['numbers_drawn']));
        if (7 != sizeof($numbersDrawn)) {
            return back()->withErrors(['numbers_drawn' => __('Le champ numéros gagnant contient plus de ou moins de sept numéros.')])->with(['error' => 'Le champ numéros gagnant est incorrect. Veuillez réessayer.'])->withInput($buyTicketData);
        }
        $numbersDrawn = array_unique($numbersDrawn);
        if (7 != sizeof($numbersDrawn)) {
            return back()->withErrors(['numbers_drawn' => __('Le champ numéros gagnant contient des doublons.')])->with(['error' => 'Le champ numéros gagnant est incorrect. Veuillez réessayer.'])->withInput($buyTicketData);
        }

        //$this->getCheckoutInvoiceToken();

        try {
            $transaction = Transaction::create([
                'user_id' => auth('customer')->user()->id,
                'lottery_id' => $buyTicketData['lottery_id'],
                'transaction_type_id' => TransactionType::whereCode('TICKET_PURCHASE')->first()?->id,
                'ticket_id' => $buyTicketData['ticket_id'],
                'status_id' => Status::whereCode('SUCCESS')->first()?->id, // Status::whereCode('FAILED')->first()?->id,
                'amount' => Ticket::find($buyTicketData['ticket_id'])->first()?->id
            ]);
        } catch (UniqueConstraintViolationException $e) {
            return back()->with(['error' => 'Vous avez deja effectuer un achat de billet pour cette loterie.'])->withInput($buyTicketData);
        }

        if ($transaction ) { //&& $transaction->status->code == 'SUCCESS'
            if (!in_array($buyTicketData['lottery_id'], auth('customer')->user()->lotteries()->pluck('id')->toArray())) {
                auth('customer')->user()->lotteries()->attach([$buyTicketData['lottery_id'] => ['numbers_drawn' => implode(', ', $numbersDrawn)]]);
            } else {
                return back()->with(['error' => 'Vous avez deja effectuer un achat de billet pour cette loterie.'])->withInput($buyTicketData);
            }
        } else {
            return back()->with(['error' => 'Une erreur inattendue est survenue lors de la création de la transaction.'])->withInput($buyTicketData);
        }
        return redirect()->route($this->profile . '.lottery.index')->with(['success' => __('L\'achat de billet a été effectué avec succès et vos numéros sont bien enregistrés.')]);
    }

    /**
     * @return void
     */
    public function getCheckoutInvoiceToken(): void
    {

        Setup::setMasterKey("ECdHNRnS-uxxc-0AMr-spem-DsDBDo1tC0bC");
        Setup::setPublicKey("test_public_wAf0gqM6jZQ3e9x4NaZCeWZKpCf");
        Setup::setPrivateKey("test_private_RfHGdIxO2DOSQW1SbwKeQyjM4oT");
        Setup::setToken("wKW4GDQLvAJ4WSxIkU64");
        Setup::setMode("test");

        //Configuration des informations de votre service/entreprise
        Store::setName("PayDunya Lotto"); // Seul le nom est requis
        Store::setTagline("PayDunya Lotto");
        Store::setPhoneNumber("97000000");
        Store::setPostalAddress("Bénin - Cotonou");
        Store::setWebsiteUrl("http://localhost:8000");
        Store::setLogoUrl("http://localhost:8000");

        $invoice = new \Paydunya\Checkout\CheckoutInvoice();

        //À insérer dans le fichier du code source qui doit effectuer l'action
        /* L'ajout d'éléments à votre facture est très basique.
        Les paramètres attendus sont nom du produit, la quantité, le prix unitaire,
        le prix total et une description optionelle. */
        $invoice->addItem("Chaussures Croco", 1, 10000, 30000, "Chaussures faites en peau de crocrodile authentique qui chasse la pauvreté");
        $invoice->setTotalAmount(42300);

        //À insérer dans le fichier du code source qui doit effectuer l'action
        // Le code suivant décrit comment créer une facture de paiement au niveau de nos serveurs,
        // rediriger ensuite le client vers la page de paiement
        // et afficher ensuite son reçu de paiement en cas de succès.
        if ($invoice->create()) {
            dd($invoice);
            header("Location: " . $invoice->getInvoiceUrl());
        } else {
            echo $invoice->response_text;
        }

    }

}
