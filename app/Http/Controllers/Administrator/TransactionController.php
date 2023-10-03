<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\Transaction\TransactionFilterRequest;
use App\Http\Requests\Administrator\Transaction\TransactionFormRequest;
use App\Models\Lottery;
use App\Models\Status;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TransactionController extends Controller
{

    /**
     * Transaction  controller construct.
     */
    public function __construct()
    {
        parent::__construct('administrator');
    }

    /**
     * Transaction list controller.
     *
     * @param TransactionFilterRequest $request The transaction  filter request.
     * @return View The package list page view.
     */
    public function index(TransactionFilterRequest $request): View
    {
        $transactionFilterData = $request->validated();

        $transactions = Transaction::when($transactionFilterData['user_id'] ?? '', function ($query) use ($transactionFilterData) {
            return $query->where('user_id', '=', $transactionFilterData['user_id']);
        })
            ->when($transactionFilterData['lottery_id'] ?? '', function ($query) use ($transactionFilterData) {
                return $query->where('lottery_id', '=', $transactionFilterData['lottery_id']);
            })
            ->when($transactionFilterData['transaction_type_id'] ?? '', function ($query) use ($transactionFilterData) {
                return $query->where('transaction_type_id', '=', $transactionFilterData['transaction_type_id']);
            })
            ->when($transactionFilterData['status_id'] ?? '', function ($query) use ($transactionFilterData) {
                return $query->where('status_id', '=', $transactionFilterData['status_id']);
            })
            // ->orderBy('id', 'desc')
            ->paginate(10);

        $users = User::where('profile', '=', 'customer')->whereNotNull('verified_at')->whereNotNull('activated_at')->get();
        $lotteries = Lottery::whereNotNull('activated_at')->get();
        $transactionTypes = TransactionType::whereNotNull('activated_at')->get();
        $statuses = Status::where('entity', '=', 'TRANSACTION')->whereNotNull('activated_at')->get();

        return view($this->profile . '.dashboard.transaction.index', ['transactions' => $transactions, 'input' => $request, 'users' => $users, 'lotteries' => $lotteries, 'transactionTypes' => $transactionTypes, 'statuses' => $statuses]);
    }

    /**
     * Create transaction  form controller.
     *
     * @return View The create transaction  form view.
     */
    public function createForm(): View
    {
        $transaction = new Transaction();
        return view($this->profile . '.dashboard.transaction.form', ['transaction' => $transaction]);
    }

    /**
     * Create transaction  traitement controller.
     *
     * @param TransactionFormRequest $request The transaction  form request.
     * @return RedirectResponse The redirect response.
     */
    public function create(TransactionFormRequest $request): RedirectResponse
    {
        $transactionData = $request->validated();
        $transactionData['code'] = strtoupper($transactionData['code']);
        $transaction = Transaction::create($transactionData);

        return redirect()->route($this->profile . '.transaction.index')->with(['success' => __('Le  de transaction :transaction- a été enregistrée avec succès.', ['transaction-' => $transaction->name])]);
    }

    /**
     * Update transaction  form controller.
     *
     * @return View The update transaction  form view.
     */
    public function updateForm(Transaction $transaction): View
    {
        return view($this->profile . '.dashboard.transaction.form', ['transaction' => $transaction]);
    }

    /**
     * Update transaction  traitement controller.
     *
     * @param TransactionFormRequest $request The transaction  form request.
     * @param Transaction $transaction The transaction .
     * @return RedirectResponse The redirect response.
     */
    public function update(TransactionFormRequest $request, Transaction $transaction): RedirectResponse
    {
        $transactionData = $request->validated();
        $transactionData['code'] = strtoupper($transactionData['code']);
        $transaction->update($transactionData);

        return redirect()->route($this->profile . '.transaction.index')->with(['success' => __('Le  de transaction :transaction- a été modifiée avec succès.', ['transaction-' => $transaction->name])]);
    }

    /**
     * Enable or disable transaction type traitement controller.
     *
     * @param Transaction $transaction The transaction.
     * @param string $new_status The transaction type new status.
     * @return RedirectResponse The redirect response.
     */
    public function enableDisable(Transaction $transaction, string $new_status): RedirectResponse
    {

        if ($new_status != 'disable' && $new_status != 'enable') {
            return back()->withErrors(['Une action inattendue bloque le processus.']);
        }

        $old_status = (is_null($transaction->activated_at)) ? 'disable' : 'enable';

        if ($new_status != $old_status && 'disable' == $new_status) {
            $transaction->activated_at = NULL;
        } else if ($new_status != $old_status && 'enable' == $new_status) {
            $transaction->activated_at = now();
        }
        $transaction->update();

        $toDo = ($new_status == 'disable') ? 'désactivée' : 'activée';

        return redirect()->route($this->profile . '.transaction.index')->with(['success' => __('Le  de transaction :transaction- a été :to-do avec succès.', ['transaction-' => $transaction->name, 'to-do' => $toDo])]);
    }

    /**
     * Delete transaction traitement controller.
     *
     * @param Transaction $transaction The transaction.
     * @return RedirectResponse The redirect response.
     */
    public function delete(Transaction $transaction): RedirectResponse
    {
        $transaction->delete();
        return redirect()->route($this->profile . '.transaction.index')->with(['success' => __('Le  de transaction :transaction- a été supprimée avec succès.', ['transaction-' => $transaction->name])]);
    }

}
