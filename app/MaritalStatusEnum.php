<?php

namespace App;

enum MaritalStatusEnum: string
{
    case Married = 'married';
    case Single = 'single';
    case Widowed = 'widowed';
    case Divorced = 'divorced';
    case Separated = 'separated';
    case Widower = 'widower';
    case Other = 'other';
}
