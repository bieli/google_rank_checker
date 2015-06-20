<?php

namespace RankChecker\Google;


class GoogleRankHash {
    protected function strToNum($Str, $Check, $Magic){
        $Int32Unit = 4294967296; // 2^32
        $length = strlen($Str);

        for ($i = 0; $i < $length; $i++) {
            $Check *= $Magic;
            if ($Check >= $Int32Unit) {
                $Check = ($Check - $Int32Unit * (int) ($Check / $Int32Unit));
                $Check = ($Check < -2147483648) ? ($Check + $Int32Unit) : $Check;
            }
            $Check += ord($Str{$i});
        }

        return $Check;
    }

    protected function hashURL($String){
        $Check1 = $this->strToNum($String, 0x1505, 0x21);
        $Check2 = $this->strToNum($String, 0, 0x1003F);
        $Check1 >>= 2;
        $Check1 = (($Check1 >> 4) & 0x3FFFFC0 ) | ($Check1 & 0x3F);
        $Check1 = (($Check1 >> 4) & 0x3FFC00 ) | ($Check1 & 0x3FF);
        $Check1 = (($Check1 >> 4) & 0x3C000 ) | ($Check1 & 0x3FFF);
        $T1 = (((($Check1 & 0x3C0) << 4) | ($Check1 & 0x3C)) <<2 ) | ($Check2 & 0xF0F );
        $T2 = (((($Check1 & 0xFFFFC000) << 4) | ($Check1 & 0x3C00)) << 0xA) | ($Check2 & 0xF0F0000 );
        return ($T1 | $T2);
    }

    protected function checkHash($Hashnum){
        $CheckByte = 0;
        $Flag = 0;
        $HashStr = sprintf('%u', $Hashnum) ;
        $length = strlen($HashStr);

        for ($i = $length - 1; $i >= 0; $i --) {
            $Re = $HashStr{$i};
            if (1 === ($Flag % 2)) {
                $Re += $Re;
                $Re = (int)($Re / 10) + ($Re % 10);
            }
            $CheckByte += $Re;
            $Flag ++;
        }

        $CheckByte %= 10;
        if (0 !== $CheckByte) {
            $CheckByte = 10 - $CheckByte;
            if (1 === ($Flag % 2) ) {
                if (1 === ($CheckByte % 2)) {
                    $CheckByte += 9;
                } else {
                    $CheckByte >>= 1;
                }
            }
        }

        return '7'.$CheckByte.$HashStr;
    }
}