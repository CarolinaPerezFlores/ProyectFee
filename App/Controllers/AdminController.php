<?php
namespace App\Controllers;
use App\Models\Proposal;

class AdminController extends BaseController {
public function getIndex() {
    
    return $this->renderHTML('admin.twig');
   }
}