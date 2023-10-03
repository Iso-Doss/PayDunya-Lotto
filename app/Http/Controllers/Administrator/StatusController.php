<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\Status\StatusFilterRequest;
use App\Http\Requests\Administrator\Status\StatusFormRequest;
use App\Models\Status;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StatusController extends Controller
{

    /**
     * Status controller construct.
     */
    public function __construct()
    {
        parent::__construct('administrator');
    }

    /**
     * Status list controller.
     *
     * @param StatusFilterRequest $request The status filter request.
     * @return View The package type list page view.
     */
    public function index(StatusFilterRequest $request): View
    {
        $statusFilterData = $request->validated();

        $statuses = Status::when($statusFilterData['status'] ?? '', function ($query) use ($statusFilterData) {
            if ('ENABLE' == $statusFilterData['status']) {
                return $query->whereNotNull('activated_at');
            } else if ('DISABLE' == $statusFilterData['status']) {
                return $query->whereNull('activated_at');
            } else if ('TRASHED' == $statusFilterData['status']) {
                return $query->onlyTrashed();
            } else {
                return $query;
            }
        })
            ->when($statusFilterData['name'] ?? '', function ($query) use ($statusFilterData) {
                return $query->where('name', 'LIKE', '%' . $statusFilterData['name'] . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view($this->profile . '.dashboard.status.index', ['statuses' => $statuses, 'input' => $request]);
    }

    /**
     * Create status form controller.
     *
     * @return View The create status form view.
     */
    public function createForm(): View
    {
        $status = new Status();
        return view($this->profile . '.dashboard.status.form', ['status' => $status]);
    }

    /**
     * Create status traitement controller.
     *
     * @param StatusFormRequest $request The status form request.
     * @return RedirectResponse The redirect response.
     */
    public function create(StatusFormRequest $request): RedirectResponse
    {
        $statusData = $request->validated();
        $statusData['code'] = strtoupper($statusData['code']);
        $status = Status::create($statusData);

        return redirect()->route($this->profile . '.status.index')->with(['success' => __('Le status :status a été enregistré avec succès.', ['status' => $status->name])]);
    }

    /**
     * Update status form controller.
     *
     * @return View The update status form view.
     */
    public function updateForm(Status $status): View
    {
        return view($this->profile . '.dashboard.status.form', ['status' => $status]);
    }

    /**
     * Update status traitement controller.
     *
     * @param StatusFormRequest $request The status form request.
     * @param Status $status The status.
     * @return RedirectResponse The redirect response.
     */
    public function update(StatusFormRequest $request, Status $status): RedirectResponse
    {
        $statusData = $request->validated();
        $statusData['code'] = strtoupper($statusData['code']);
        $status->update($statusData);

        return redirect()->route($this->profile . '.status.index')->with(['success' => __('Le statut :status a été modifié avec succès.', ['status' => $status->name])]);
    }

    /**
     * Enable or disable status traitement controller.
     *
     * @param Status $status The status.
     * @param string $new_status The status new status.
     * @return RedirectResponse The redirect response.
     */
    public function enableDisable(Status $status, string $new_status): RedirectResponse
    {

        if ($new_status != 'disable' && $new_status != 'enable') {
            return back()->withErrors(['Une action inattendue bloque le processus.']);
        }

        $old_status = (is_null($status->activated_at)) ? 'disable' : 'enable';

        if ($new_status != $old_status && 'disable' == $new_status) {
            $status->activated_at = NULL;
        } else if ($new_status != $old_status && 'enable' == $new_status) {
            $status->activated_at = now();
        }
        $status->update();

        $toDo = ($new_status == 'disable') ? 'désactivé' : 'activé';

        return redirect()->route($this->profile . '.status.index')->with(['success' => __('Le statut :status a été :to-do avec succès.', ['status' => $status->name, 'to-do' => $toDo])]);
    }

    /**
     * Delete status traitement controller.
     *
     * @param Status $status The status.
     * @return RedirectResponse The redirect response.
     */
    public function delete(Status $status): RedirectResponse
    {
        $status->delete();
        return redirect()->route($this->profile . '.status.index')->with(['success' => __('Le statut :status a été supprimé avec succès.', ['status' => $status->name])]);
    }

}
