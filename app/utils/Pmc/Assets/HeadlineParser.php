<?php


namespace App\utils\Pmc\Assets;


class HeadlineParser
{
    static public function Parse($input) {
        if(!$input) return null;

        $strip = str_replace(['[PRIMARY]', '[SECONDARY]', '[BR]', ], '', $input);
        $strip = str_replace(['[NOBR]', ], ' ', $strip);

        $parts = [];

        $currentColor = 'primary';
        $tail = $input;
        while(true) {
            $part = $tail;

            $primaryPos = strpos($tail, '[PRIMARY]');
            $secondaryPos = strpos($tail, '[SECONDARY]');

            if(false === $primaryPos && false === $secondaryPos) {
                $parts[] = [
                    'color' => $currentColor,
                    'body' => $part,
                ];
                $tail = '';
                break;
            }

            if(false === $primaryPos || $secondaryPos < $primaryPos) {
                // Secondary
                $part = substr($tail, 0, $secondaryPos);
                if(0 < strlen($part)) {
                    $parts[] = [
                        'color' => $currentColor,
                        'body' => $part,
                    ];
                }
                $currentColor = 'secondary';
                $tail = substr($tail, $secondaryPos + 11);
            } else {
                // Primary
                $part = substr($tail, 0, $primaryPos);
                if(0 < strlen($part)) {
                    $parts[] = [
                        'color' => $currentColor,
                        'body' => $part,
                    ];
                }
                $currentColor = 'primary';
                $tail = substr($tail, $primaryPos + 11);
            }
        }

        return [
            'raw' => $input,
            'strip' => trim($strip),
            'parts' => $parts,
        ];
    }
}
