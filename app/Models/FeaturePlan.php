<?php

namespace App\Models;

use App\Models\RolePermission;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class FeaturePlan extends Model 
{
    protected $table = 'feature_plan'; 
  use HasFactory ;
}