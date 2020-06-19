<?php
namespace App\Controllers;
use App\Models\Proposal;

class indexController extends BaseController {
public function indexAction() {
    $proposals = Proposal::all();
    // $name = 'Todas las propuestas';

    return $this->renderHTML('add-proposal.twig', [
        // 'name' => $name,
        'proposals' => $proposals
    ]);
   }


}