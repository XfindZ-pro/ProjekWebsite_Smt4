<?php

namespace PHPMailer\PHPMailer;

class PHPMailer
{
    public const ENCRYPTION_STARTTLS = 'tls';
    public const ENCRYPTION_SMTPS = 'ssl';

    public bool $SMTP = false;
    public bool $SMTPAuth = false;
    public string $Host = '';
    public string $Username = '';
    public string $Password = '';
    public string $SMTPSecure = '';
    public int $Port = 25;
    public string $From = '';
    public string $FromName = '';
    public array $to = [];
    public string $Subject = '';
    public string $Body = '';
    public bool $isHtml = false;
    public bool $exceptions = false;

    public function __construct(bool $exceptions = false)
    {
        $this->exceptions = $exceptions;
    }

    public function isSMTP(): void
    {
        $this->SMTP = true;
    }

    public function setFrom(string $address, string $name = ''): bool
    {
        $this->From = $address;
        $this->FromName = $name;
        return true;
    }

    public function addAddress(string $address, string $name = ''): bool
    {
        $this->to[] = ['address' => $address, 'name' => $name];
        return true;
    }

    public function isHTML(bool $isHtml = true): void
    {
        $this->isHtml = $isHtml;
    }

    public function send(): bool
    {
        if (empty($this->to)) {
            if ($this->exceptions) {
                throw new Exception('No recipients provided');
            }
            return false;
        }

        $to = implode(', ', array_map(fn ($recipient) => $recipient['address'], $this->to));
        $headers = [];
        $headers[] = 'From: ' . ($this->FromName ? $this->FromName . ' <' . $this->From . '>' : $this->From);
        if ($this->isHtml) {
            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=UTF-8';
        }
        $headers[] = 'X-Mailer: PHP/' . phpversion();

        $result = mail($to, $this->Subject, $this->Body, implode("\r\n", $headers));
        if (!$result && $this->exceptions) {
            throw new Exception('Unable to send email');
        }

        return $result;
    }
}
