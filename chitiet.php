<?php

class Chitiet{
    public $macb;
    public $userid;
    public $khoa;
    public $tendetai;
    public $loaict;
    public $cap;
    public $ketthuc;
    public $soluong;
    public $vitri;
    public $quydoi;  
    public $namhoc;

    public $tinchi;

    function __construct() {
        $this->vitri = "";
        $this->soluong = "";
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
     * Get the value of tendetai
     */ 
    public function getTendetai()
    {
        return $this->tendetai;
    }

    /**
     * Set the value of tendetai
     *
     * @return  self
     */ 
    public function setTendetai($tendetai)
    {
        $this->tendetai = $tendetai;

        return $this;
    }

    /**
     * Get the value of loaict
     */ 
    public function getLoaict()
    {
        return $this->loaict;
    }

    /**
     * Set the value of loaict
     *
     * @return  self
     */ 
    public function setLoaict($loaict)
    {
        $this->loaict = $loaict;

        return $this;
    }

    /**
     * Get the value of cap
     */ 
    public function getCap()
    {
        return $this->cap;
    }

    /**
     * Set the value of cap
     *
     * @return  self
     */ 
    public function setCap($cap)
    {
        $this->cap = $cap;

        return $this;
    }

    /**
     * Get the value of ketthuc
     */ 
    public function getKetthuc()
    {
        return $this->ketthuc;
    }

    /**
     * Set the value of ketthuc
     *
     * @return  self
     */ 
    public function setKetthuc($ketthuc)
    {
        $this->ketthuc = $ketthuc;

        return $this;
    }

    /**
     * Get the value of soluong
     */ 
    public function getSoluong()
    {
        return $this->soluong;
    }

    /**
     * Set the value of soluong
     *
     * @return  self
     */ 
    public function setSoluong($soluong)
    {
        $this->soluong = $soluong;

        return $this;
    }

    /**
     * Get the value of vitri
     */ 
    public function getVitri()
    {
        return $this->vitri;
    }

    /**
     * Set the value of vitri
     *
     * @return  self
     */ 
    public function setVitri($vitri)
    {
        $this->vitri = $vitri;

        return $this;
    }

    /**
     * Get the value of quydoi
     */ 
    public function getQuydoi()
    {
        return $this->quydoi;
    }

    /**
     * Set the value of quydoi
     *
     * @return  self
     */ 
    public function setQuydoi($quydoi)
    {
        $this->quydoi = $quydoi;

        return $this;
    }

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
     * Get the value of tinchi
     */ 
    public function getTinchi()
    {
        return $this->tinchi;
    }

    /**
     * Set the value of tinchi
     *
     * @return  self
     */ 
    public function setTinchi($tinchi)
    {
        $this->tinchi = $tinchi;

        return $this;
    }
}
?>