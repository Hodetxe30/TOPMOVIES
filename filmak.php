<?php
class Filmak
{
    private $filmak;

    public function __construct()
    {
        $this->filmak = [];
    }
    public function getFilmak()
    {
        return $this->filmak;
    }
    public function gehitu(Filma $filma)
    {
        $this->filmak[$filma->getISAN()] = $filma;
    }
    public function bilatuISAN($ISAN)
    {
        if (isset($this->filmak[$ISAN])) {
            return $this->filmak[$ISAN];
        }
        return null;
    }
    public function ezabatu($ISAN)
    {
        if (isset($this->filmak[$ISAN])) {
            unset($this->filmak[$ISAN]);
            return true;
        }
        return false;
    }

    public function bilatuIzenez($izena)
    {
        $emaitza = [];
        foreach ($this->filmak as $filma) {
            if (strcasecmp($filma->getIzena(), $izena) == 0) {
                $emaitza[] = $filma;
            }
        }
        return $emaitza;
    }
    public function eguneratu ($ISAN, $izena, $puntuazioa){
        if (isset($this->filmak[$ISAN])) {
            $this->filmak[$ISAN]->setIzena($izena);
            $this->filmak[$ISAN]->setPuntuazioa($puntuazioa);
            return true;
    }
    return false;
}
}
?>