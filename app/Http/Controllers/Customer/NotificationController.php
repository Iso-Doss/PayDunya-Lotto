<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotificationFilterRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NotificationController extends Controller
{

    /**
     * Notification controller construct.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Notification list controller.
     *
     * @param NotificationFilterRequest $request The notification filter request.
     * @return View The notification list page view.
     */
    public function index(NotificationFilterRequest $request): View
    {

        $notificationFilterData = $request->validated();

        $notifications = Auth::user()->notifications
            ->when($notificationFilterData['status'] ?? '', function ($query) use ($notificationFilterData) {
                if ('READ' == $notificationFilterData['status']) {
                    return $query->whereNotNull('read_at');
                } else if ('UNREAD' == $notificationFilterData['status']) {
                    return $query->whereNull('read_at');
                } else {
                    return $query;
                }
            })
            ->when($notificationFilterData['search'] ?? '', function ($query) use ($notificationFilterData) {
                return $query->where('data', 'LIKE', '%' . $notificationFilterData['search'] . '%');
            });

        return view($this->profile . '.dashboard.notification', ['notifications' => $notifications, 'input' => $notificationFilterData]);
    }

    /**
     * Mark a notification as read or unread traitement controller.
     *
     * @param string $notificationId The notification id.
     * @param string $new_status The new status.
     * @return RedirectResponse The redirect response.
     */
    public function markAsReadOrAsUnread(string $notificationId, string $new_status): RedirectResponse
    {
        $notification = Auth::user()->notifications->where('id', '=', $notificationId)->first();
        if (!is_null($notification)) {
            $toDo = '';
            if ($new_status == 'READ') {
                $notification->markAsRead();
                $toDo = 'lu';
            } elseif ($new_status == 'UNREAD') {
                $notification->markAsUnread();
                $toDo = 'non lu';
            }
            return redirect()->route($this->profile . '.notification.index')->with(['success' => __('Votre notification a été marquée comme :to-do avec succès.', ['to-do' => $toDo])]);
        } else {
            return back()->with(['error' => __('Impossible de changer le status de cette notification.')]);
        }
    }

    /**
     *  Delete a notification traitement controller.
     *
     * @param string $notificationId The notification id.
     * @return RedirectResponse The redirect response.
     */
    public function delete(string $notificationId): RedirectResponse
    {
        $notification = Auth::user()->notifications->where('id', '=', $notificationId)->first();
        if (!is_null($notification)) {
            $notification->delete();
            return redirect()->route($this->profile . '.notification.index')->with(['success' => 'Votre notification a été supprimée avec succès.']);
        } else {
            return back()->with(['error' => __('Impossible de supprimer cette notification')]);
        }
    }

    /**
     * Mark all notifications as read or unread traitement controller.
     *
     * @param string $new_status The new status.
     * @return RedirectResponse The redirect response.
     */
    public function markAllAsReadOrAsUnread(string $new_status): RedirectResponse
    {
        $notifications = Auth::user()->notifications;
        $toDo = '';
        if ($new_status == 'READ') {
            $notifications->markAsRead();
            $toDo = 'lu';
        } elseif ($new_status == 'UNREAD') {
            $notifications->markAsUnread();
            $toDo = 'non lu';
        }
        return redirect()->route($this->profile . '.notification.index')->with(['success' => __('Vow notifications ont été marquées comme :to-do avec succès.', ['to-do' => $toDo])]);

    }

    /**
     * Delete all notifications traitement controller.
     *
     * @return RedirectResponse The redirect response.
     */
    public function deleteAll(): RedirectResponse
    {
        Auth::user()->notifications()->delete();
        return redirect()->route($this->profile . '.notification.index')->with(['success' => 'Vos notifications ont été supprimées avec succès.']);
    }

}
