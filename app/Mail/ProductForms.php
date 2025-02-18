<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class ProductForms extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public $order,
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Опросные листы для заказа продукции',
        );
    }

    public function attachments(): array
    {
        return [
          Attachment::fromStorageDisk('public', '/docs/1.docx')->as('Форма опросного листа для заказа блоков предохранительных клапанов.docx'),
          Attachment::fromStorageDisk('public', '/docs/2.docx')->as('Форма опросного листа для заказа задвижек клиновых стальных.docx'),
          Attachment::fromStorageDisk('public', '/docs/3.docx')->as('Форма опросного листа для заказа клапанов запорных (вентелей).docx'),
          Attachment::fromStorageDisk('public', '/docs/4.docx')->as('Форма опросного листа для заказа клапанов обратных поворотных.docx'),
          Attachment::fromStorageDisk('public', '/docs/5.docx')->as('Форма опросного листа для заказа клапанов обратных подъемных.docx'),
          Attachment::fromStorageDisk('public', '/docs/6.docx')->as('Форма опросного листа для заказа клапанов предохранительных.docx'),
          Attachment::fromStorageDisk('public', '/docs/7.docx')->as('Форма опросного листа для заказа кранов шаровых запорно-регулирующих.docx'),
          Attachment::fromStorageDisk('public', '/docs/8.docx')->as('Форма опросного листа для заказа кранов шаровых с дополнением для ПП.docx'),
          Attachment::fromStorageDisk('public', '/docs/9.docx')->as('Форма опросного листа для заказа кранов шаровых.docx'),
          Attachment::fromStorageDisk('public', '/docs/10.docx')->as('Форма опросного листа для заказа устройств переключающих.docx'),
          Attachment::fromStorageDisk('public', '/docs/11.docx')->as('Форма опросного листа для затворов дисковых.docx'),
        ];
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.forms',
        );
    }
}
