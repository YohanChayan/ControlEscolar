<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Channels\Messages\WhatsAppMessage;
use App\Channels\WhatsAppChannel;
use App\Models\Tramite;
use App\Models\TramiteSolicitado;
use Carbon\Carbon;


class TramiteProcesado extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

     public $tramite;

    public function __construct(TramiteSolicitado $tramite)
    {
        $this->tramite = $tramite;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [WhatsAppChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toWhatsApp($notifiable)
      {
        $tramiteUrl = url("/tramites/{$this->tramite->id}");
        $tramite = Tramite::find($this->tramite->tramite_id)->nombre_tramite;

        $date = Carbon::parse($this->tramite->created_at)->format('d-m-Y');

        $entity = 'Control Escolar';
        return (new WhatsAppMessage)
            ->content("{$entity} \nTu tramite de {$tramite} Ha sido iniciado el {$date}. Detalles en: {$tramiteUrl}");
      }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
}
