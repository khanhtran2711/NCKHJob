<?php

class Nhiemvu{
    public $macb;
    public $userid;
    public $khoa;
    public $detai;
    public $giaotrinh;
    public $sach;
    public $tailieu;
    public $baitapchi;
    public $baikyyeu;
    public $huongsv;
    public $svnckh;  
    public $olympic;
    public $total;
    public $dinhmuc;
    public $vuot;
    public $note;
    public $namhoc;

    function __construct() {
        $this->detai = 0;
        $this->giaotrinh = 0;
        $this->sach = 0;
        $this->tailieu = 0;
        $this->baitapchi = 0;
        $this->baikyyeu = 0;
        $this->huongsv = 0;
        $this->svnckh = 0;
        $this->olympic = 0;
      }
      public function sumTotal(){
        return $this->detai +
        $this->giaotrinh+
        $this->sach+
        $this->tailieu+
        $this->baitapchi +
        $this->baikyyeu+
        $this->huongsv +
        $this->svnckh +
        $this->olympic;
      }
    /**
     * Get the value of macb
     */ 
    public function getMacb()
    {
        return $this->macb;
    }

    /**
     * Set the value of macb
     *
     * @return  self
     */ 
    public function setMacb($macb)
    {
        $this->macb = $macb;

        return $this;
    }

    /**
     * Get the value of detai
     */ 
    public function getDetai()
    {
        return $this->detai;
    }

    /**
     * Set the value of detai
     *
     * @return  self
     */ 
    public function setDetai($detai)
    {
        $this->detai = $detai;

        return $this;
    }

    /**
     * Get the value of giaotrinh
     */ 
    public function getGiaotrinh()
    {
        return $this->giaotrinh;
    }

    /**
     * Set the value of giaotrinh
     *
     * @return  self
     */ 
    public function setGiaotrinh($giaotrinh)
    {
        $this->giaotrinh = $giaotrinh;

        return $this;
    }

    /**
     * Get the value of sach
     */ 
    public function getSach()
    {
        return $this->sach;
    }

    /**
     * Set the value of sach
     *
     * @return  self
     */ 
    public function setSach($sach)
    {
        $this->sach = $sach;

        return $this;
    }

    /**
     * Get the value of tailieu
     */ 
    public function getTailieu()
    {
        return $this->tailieu;
    }

    /**
     * Set the value of tailieu
     *
     * @return  self
     */ 
    public function setTailieu($tailieu)
    {
        $this->tailieu = $tailieu;

        return $this;
    }

    /**
     * Get the value of baitapchi
     */ 
    public function getBaitapchi()
    {
        return $this->baitapchi;
    }

    /**
     * Set the value of baitapchi
     *
     * @return  self
     */ 
    public function setBaitapchi($baitapchi)
    {
        $this->baitapchi = $baitapchi;

        return $this;
    }

    /**
     * Get the value of baikyyeu
     */ 
    public function getBaikyyeu()
    {
        return $this->baikyyeu;
    }

    /**
     * Set the value of baikyyeu
     *
     * @return  self
     */ 
    public function setBaikyyeu($baikyyeu)
    {
        $this->baikyyeu = $baikyyeu;

        return $this;
    }

    /**
     * Get the value of huongsv
     */ 
    public function getHuongsv()
    {
        return $this->huongsv;
    }

    /**
     * Set the value of huongsv
     *
     * @return  self
     */ 
    public function setHuongsv($huongsv)
    {
        $this->huongsv = $huongsv;

        return $this;
    }

    /**
     * Get the value of svnkch
     */ 
   

    /**
     * Get the value of olympic
     */ 
    public function getOlympic()
    {
        return $this->olympic;
    }

    /**
     * Set the value of olympic
     *
     * @return  self
     */ 
    public function setOlympic($olympic)
    {
        $this->olympic = $olympic;

        return $this;
    }

    /**
     * Get the value of userid
     */ 
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set the value of userid
     *
     * @return  self
     */ 
    public function setUserid($userid)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get the value of dinhmuc
     */ 


    /**
     * Get the value of khoa
     */ 
    public function getKhoa()
    {
        return $this->khoa;
    }

    /**
     * Set the value of khoa
     *
     * @return  self
     */ 
    public function setKhoa($khoa)
    {
        $this->khoa = $khoa;

        return $this;
    }

    /**
     * Get the value of total
     */ 
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set the value of total
     *
     * @return  self
     */ 
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get the value of dinhmuc
     */ 
    public function getDinhmuc()
    {
        return $this->dinhmuc;
    }

    /**
     * Set the value of dinhmuc
     *
     * @return  self
     */ 
    public function setDinhmuc($dinhmuc)
    {
        $this->dinhmuc = $dinhmuc;

        return $this;
    }

    /**
     * Get the value of vuot
     */ 
    public function getVuot()
    {
        return $this->vuot;
    }

    /**
     * Set the value of vuot
     *
     * @return  self
     */ 
    public function setVuot($vuot)
    {
        $this->vuot = $vuot;

        return $this;
    }

    /**
     * Get the value of note
     */ 
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set the value of note
     *
     * @return  self
     */ 
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get the value of namhoc
     */ 
    public function getNamhoc()
    {
        return $this->namhoc;
    }

    /**
     * Set the value of namhoc
     *
     * @return  self
     */ 
    public function setNamhoc($namhoc)
    {
        $this->namhoc = $namhoc;

        return $this;
    }

    /**
     * Get the value of svnckh
     */ 
    public function getSvnckh()
    {
        return $this->svnckh;
    }

    /**
     * Set the value of svnckh
     *
     * @return  self
     */ 
    public function setSvnckh($svnckh)
    {
        $this->svnckh = $svnckh;

        return $this;
    }
}
?>