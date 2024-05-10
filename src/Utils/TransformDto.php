<?php

namespace App\Utils;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class TransformDto{

    public function __construct(){}

    public function encoderDto (array $dtoList){
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
    
        $jsonContent = json_decode($serializer->serialize($dtoList, 'json'));
        return $jsonContent;
    }

    public function decoderDtoObject ($dtoList){
        $decoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $decoders);
    
        $jsonContent = json_encode($serializer->serialize($dtoList, 'json'));
        return $jsonContent;
    }

    public function encoderDtoObject ($dtoList){
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
    
        $jsonContent = json_decode($serializer->serialize($dtoList, 'json'));
        return $jsonContent;
    }

    public function decoderDto (array $dtoList){
        $decoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $decoders);
    
        $jsonContent = json_encode($serializer->serialize($dtoList, 'json'));
        return $jsonContent;
    }

    

}


?>