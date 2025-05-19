<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use App\Models\User;

class CadastroParaAprovacaoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $link;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->link = URL::signedRoute('admin.usuario.aprovacao.ver', ['user' => $user->id]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Novo cadastro pendente de aprovação'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.aprovacao-cadastro'
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
