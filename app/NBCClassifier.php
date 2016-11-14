<?php

namespace App;

class NBCClassifier
{

    protected $dokumenlearning;
    protected $dokumenTest;
    protected $n_dokumenLearning;
    protected $n_dokumenLearningTepat;
    protected $n_dokumenLearningTerlambat;

    public function __construct($dokumenTest)
    {
        $this->dokumenlearning = DokumenLearning::all();
        $this->dokumenTest = $dokumenTest;
        $this->n_dokumenLearning = $this->dokumenlearning->count();
        $this->n_dokumenLearningTepat = $this->dokumenlearning->where('class', 'Lulus tepat waktu')->count();
        $this->n_dokumenLearningTerlambat = $this->dokumenlearning->where('class', 'Tidak tepat waktu')->count();
    }

    public function classify()
    {
        $priors = $this->hitungPriors();
        $cp = $this->hitungCP();
        $cpPerAttribut = $this->hitungCPPerAttribut();
        $result = [
            'P(Ci|Tepat waktu) . P(X|Tepat waktu)' => $priors['P(Tepat waktu)'] * $cpPerAttribut['Tepat waktu'],
            'P(Ci|Terlambat) . P(X|Terlambat)' => $priors['P(Terlambat)'] * $cpPerAttribut['Terlambat'],
        ];

        return [
            'P(class) / priors' => $priors,
            'conditional probabilities' => $cp,
            'P(X|class)' => $cpPerAttribut,
            'P(C|class)' => $result,
            'hasil' => $result['P(Ci|Tepat waktu) . P(X|Tepat waktu)'] >= $result['P(Ci|Terlambat) . P(X|Terlambat)'] ? 'Tepat waktu' : 'Terlambat'
        ];
    }

    protected function hitungPriors()
    {
        return [
            'P(Tepat waktu)' => $this->n_dokumenLearningTepat / $this->n_dokumenLearning,
            'P(Terlambat)' => $this->n_dokumenLearningTerlambat / $this->n_dokumenLearning,
        ];
    }

    protected function hitungCP()
    {
        $cp = [];

        foreach ($this->dokumenTest as $key => $value) {
            $cp['P(' . $key . '|Tepat waktu)'] = ( 1 + $this->dokumenlearning->where('class', 'Lulus tepat waktu')->where($key, $this->dokumenTest->$key)->count()) / $this->n_dokumenLearningTepat;
            $cp['P(' . $key . '|Terlambat)'] = ( 1 + $this->dokumenlearning->where('class', 'Tidak tepat waktu')->where($key, $this->dokumenTest->$key)->count()) / $this->n_dokumenLearningTerlambat;
        }

        return $cp;
    }

    protected function hitungCPPerAttribut()
    {
        $cpAll = $this->hitungCP();

        $cp1 = 0;
        $cp2 = 0;

        foreach ($this->dokumenTest as $key => $value) {
            if ($cp1 == 0) $cp1 = 1;
            if ($cp2 == 0) $cp2 = 1;

            $cp1 = $cp1 * $cpAll['P(' . $key . '|Tepat waktu)'];
            $cp2 = $cp2 * $cpAll['P(' . $key . '|Terlambat)'];
        }

        return [
            'Tepat waktu' => $cp1,
            'Terlambat' => $cp2,
        ];
    }
}