<?php
class Creneau {

    public $debut;

    public $fin;

    public function __construct(int $debut, int $fin)
    {
        $this->debut = $debut;
        $this->fin = $fin;
    }

    public function incluHeure(int $heure): bool
    {
        return $heure >= $this->debut && $heure <= $this->fin;
    }

    public function toHtml (): string
    {
        return "<strong>De {$this->debut}h a {$this->fin}h</strong>";
    }

    public function intercept(Creneau $creneau): bool
    {
        return $this->incluHeure($creneau->debut) ||
            $this->incluHeure($creneau->fin) ||
            ($this->debut > $creneau->debut && $this->fin < $creneau->fin);
    }

}