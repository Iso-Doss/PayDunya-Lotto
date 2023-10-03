<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\Ticket\TicketFilterRequest;
use App\Http\Requests\Administrator\Ticket\TicketFormRequest;
use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TicketController extends Controller
{

    /**
     * Ticket controller construct.
     */
    public function __construct()
    {
        parent::__construct('administrator');
    }

    /**
     * Ticket list controller.
     *
     * @param TicketFilterRequest $request The ticket filter request.
     * @return View The package type list page view.
     */
    public function index(TicketFilterRequest $request): View
    {
        $ticketFilterData = $request->validated();

        $tickets = Ticket::when($ticketFilterData['status'] ?? '', function ($query) use ($ticketFilterData) {
            if ('ENABLE' == $ticketFilterData['status']) {
                return $query->whereNotNull('activated_at');
            } else if ('DISABLE' == $ticketFilterData['status']) {
                return $query->whereNull('activated_at');
            } else if ('TRASHED' == $ticketFilterData['status']) {
                return $query->onlyTrashed();
            } else {
                return $query;
            }
        })
            ->when($ticketFilterData['name'] ?? '', function ($query) use ($ticketFilterData) {
                return $query->where('name', 'LIKE', '%' . $ticketFilterData['name'] . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view($this->profile . '.dashboard.ticket.index', ['ticketes' => $tickets, 'input' => $request]);
    }

    /**
     * Create ticket form controller.
     *
     * @return View The create ticket form view.
     */
    public function createForm(): View
    {
        $ticket = new Ticket();
        return view($this->profile . '.dashboard.ticket.form', ['ticket' => $ticket]);
    }

    /**
     * Create ticket traitement controller.
     *
     * @param TicketFormRequest $request The ticket form request.
     * @return RedirectResponse The redirect response.
     */
    public function create(TicketFormRequest $request): RedirectResponse
    {
        $ticketData = $request->validated();
        if (!empty($ticketData['image'])) {
            $upload = $this->uploadImage($request, 'ticket');
            $ticketData['image'] = (!empty($upload)) ? $upload : null;
        } else {
            $ticketData['image'] = null;
        }
        $ticket = Ticket::create($ticketData);

        return redirect()->route($this->profile . '.ticket.index')->with(['success' => __('Le billet :ticket a été enregistré avec succès.', ['ticket' => $ticket->name])]);
    }

    /**
     * Update ticket form controller.
     *
     * @return View The update ticket form view.
     */
    public function updateForm(Ticket $ticket): View
    {
        return view($this->profile . '.dashboard.ticket.form', ['ticket' => $ticket]);
    }

    /**
     * Update ticket traitement controller.
     *
     * @param TicketFormRequest $request The ticket form request.
     * @param Ticket $ticket The ticket.
     * @return RedirectResponse The redirect response.
     */
    public function update(TicketFormRequest $request, Ticket $ticket): RedirectResponse
    {
        $ticketData = $request->validated();
        if (!empty($ticketData['image'])) {
            if (!empty($ticket->image)) {
                Storage::disk('public')->delete($ticket->image);
            }
            $upload = $this->uploadImage($request, 'ticket');
            $ticketData['image'] = (!empty($upload)) ? $upload : null;
        }
        $ticket->update($ticketData);

        return redirect()->route($this->profile . '.ticket.index')->with(['success' => __('Le billet :ticket a été modifié avec succès.', ['ticket' => $ticket->name])]);
    }

    /**
     * Enable or disable ticket traitement controller.
     *
     * @param Ticket $ticket The ticket.
     * @param string $new_status The ticket new status.
     * @return RedirectResponse The redirect response.
     */
    public function enableDisable(Ticket $ticket, string $new_status): RedirectResponse
    {

        if ($new_status != 'disable' && $new_status != 'enable') {
            return back()->withErrors(['Une action inattendue bloque le processus.']);
        }

        $old_ticket = (is_null($ticket->activated_at)) ? 'disable' : 'enable';

        if ($new_status != $old_ticket && 'disable' == $new_status) {
            $ticket->activated_at = NULL;
        } else if ($new_status != $old_ticket && 'enable' == $new_status) {
            $ticket->activated_at = now();
        }
        $ticket->update();

        $toDo = ($new_status == 'disable') ? 'désactivé' : 'activé';

        return redirect()->route($this->profile . '.ticket.index')->with(['success' => __('Le billet :ticket a été :to-do avec succès.', ['ticket' => $ticket->name, 'to-do' => $toDo])]);
    }

    /**
     * Delete ticket traitement controller.
     *
     * @param Ticket $ticket The ticket.
     * @return RedirectResponse The redirect response.
     */
    public function delete(Ticket $ticket): RedirectResponse
    {
        $ticket->delete();
        return redirect()->route($this->profile . '.ticket.index')->with(['success' => __('Le billet :ticket a été supprimé avec succès.', ['ticket' => $ticket->name])]);
    }

}
