<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\TransactionType\TransactionTypeFilterRequest;
use App\Http\Requests\Administrator\TransactionType\TransactionTypeFormRequest;
use App\Models\TransactionType;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TransactionTypeController extends Controller
{

    /**
     * Transaction type controller construct.
     */
    public function __construct()
    {
        parent::__construct('administrator');
    }

    /**
     * Transaction type list controller.
     *
     * @param TransactionTypeFilterRequest $request The transaction type filter request.
     * @return View The package type list page view.
     */
    public function index(TransactionTypeFilterRequest $request): View
    {
        $transactionTypeFilterData = $request->validated();

        $transactionTypes = TransactionType::when($transactionTypeFilterData['status'] ?? '', function ($query) use ($transactionTypeFilterData) {
            if ('ENABLE' == $transactionTypeFilterData['status']) {
                return $query->whereNotNull('activated_at');
            } else if ('DISABLE' == $transactionTypeFilterData['status']) {
                return $query->whereNull('activated_at');
            } else if ('TRASHED' == $transactionTypeFilterData['status']) {
                return $query->onlyTrashed();
            } else {
                return $query;
            }
        })
            ->when($transactionTypeFilterData['name'] ?? '', function ($query) use ($transactionTypeFilterData) {
                return $query->where('name', 'LIKE', '%' . $transactionTypeFilterData['name'] . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view($this->profile . '.dashboard.transaction-type.index', ['transactionTypes' => $transactionTypes, 'input' => $request]);
    }

    /**
     * Create transaction type form controller.
     *
     * @return View The create transaction type form view.
     */
    public function createForm(): View
    {
        $transactionType = new TransactionType();
        return view($this->profile . '.dashboard.transaction-type.form', ['transactionType' => $transactionType]);
    }

    /**
     * Create transaction type traitement controller.
     *
     * @param TransactionTypeFormRequest $request The transaction type form request.
     * @return RedirectResponse The redirect response.
     */
    public function create(TransactionTypeFormRequest $request): RedirectResponse
    {
        $transactionTypeData = $request->validated();
        $transactionTypeData['code'] = strtoupper($transactionTypeData['code']);
        $transactionType = TransactionType::create($transactionTypeData);

        return redirect()->route($this->profile . '.transaction-type.index')->with(['success' => __('Le type de transaction :transaction-type a été enregistré avec succès.', ['transaction-type' => $transactionType->name])]);
    }

    /**
     * Update transaction type form controller.
     *
     * @return View The update transaction type form view.
     */
    public function updateForm(TransactionType $transactionType): View
    {
        return view($this->profile . '.dashboard.transaction-type.form', ['transactionType' => $transactionType]);
    }

    /**
     * Update transaction type traitement controller.
     *
     * @param TransactionTypeFormRequest $request The transaction type form request.
     * @param TransactionType $transactionType The transaction type.
     * @return RedirectResponse The redirect response.
     */
    public function update(TransactionTypeFormRequest $request, TransactionType $transactionType): RedirectResponse
    {
        $transactionTypeData = $request->validated();
        $transactionTypeData['code'] = strtoupper($transactionTypeData['code']);
        $transactionType->update($transactionTypeData);

        return redirect()->route($this->profile . '.transaction-type.index')->with(['success' => __('Le type de transaction :transaction-type a été modifié avec succès.', ['transaction-type' => $transactionType->name])]);
    }

    /**
     * Enable or disable transaction type traitement controller.
     *
     * @param TransactionType $transactionType The transaction type.
     * @param string $new_status The transaction type new status.
     * @return RedirectResponse The redirect response.
     */
    public function enableDisable(TransactionType $transactionType, string $new_status): RedirectResponse
    {

        if ($new_status != 'disable' && $new_status != 'enable') {
            return back()->withErrors(['Une action inattendue bloque le processus.']);
        }

        $old_status = (is_null($transactionType->activated_at)) ? 'disable' : 'enable';

        if ($new_status != $old_status && 'disable' == $new_status) {
            $transactionType->activated_at = NULL;
        } else if ($new_status != $old_status && 'enable' == $new_status) {
            $transactionType->activated_at = now();
        }
        $transactionType->update();

        $toDo = ($new_status == 'disable') ? 'désactivé' : 'activé';

        return redirect()->route($this->profile . '.transaction-type.index')->with(['success' => __('Le type de transaction :transaction-type a été :to-do avec succès.', ['transaction-type' => $transactionType->name, 'to-do' => $toDo])]);
    }

    /**
     * Delete transaction type traitement controller.
     *
     * @param TransactionType $transactionType The transaction type.
     * @return RedirectResponse The redirect response.
     */
    public function delete(TransactionType $transactionType): RedirectResponse
    {
        $transactionType->delete();
        return redirect()->route($this->profile . '.transaction-type.index')->with(['success' => __('Le type de transaction :transaction-type a été supprimé avec succès.', ['transaction-type' => $transactionType->name])]);
    }

}
