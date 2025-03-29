<?php

namespace App\Controllers;

use App\Models\Timbre;
use App\Models\Image;
use App\Models\Pays;
use App\Models\Certification;
use App\Models\EtatTimbre;
use App\Models\Utilisateur;
use App\Providers\View;
use App\Providers\Validator;

class TimbreController
{
    public function index() {
        $timbres = (new Timbre)->select();

        foreach ($timbres as $t) {
            $image = (new Image)->where('timbre_id', $t->id);
            $t->image = $image ? $image->image_principale : null;
        }

        return View::render('timbre/index', compact('timbres'));
    }

    public function create() {
        return View::render('timbre/create', [
            'timbre' => [],
            'errors' => [],
            'pays' => (new Pays)->select(),
            'certifications' => (new Certification)->select(),
            'etats' => (new EtatTimbre)->select(),
            'utilisateurs' => (new Utilisateur)->select()
        ]);
    }

    public function store($data) {
        $validator = new Validator;
        $validator->field('nom', $data['nom'])->required()->min(2);
        $validator->field('description', $data['description'])->required();
        $validator->field('annee', $data['annee'])->required()->min(4)->max(4);
        $validator->field('pays_id', $data['pays_id'])->required();
        $validator->field('certification_id', $data['certification_id'])->required();
        $validator->field('etat_timbre_id', $data['etat_timbre_id'])->required();
        $validator->field('utilisateur_id', $data['utilisateur_id'])->required();
    
        if ($validator->isSuccess()) {
            $timbre_id = (int) (new Timbre)->insert($data);
    
            if ($timbre_id && isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $imageName = uniqid() . '_' . $_FILES['image']['name'];
                $targetPath = 'public/assets/img/timbres/' . $imageName;
                move_uploaded_file($_FILES['image']['tmp_name'], $targetPath);
    
                $image_id = (new Image)->insert([
                    'image_principale' => $imageName,
                    'timbre_id' => $timbre_id
                ]);

                if ($image_id) {
                    (new Timbre)->update($timbre_id, ['image' => $image_id]);
                }
            }
    
            return View::redirect('timbre');
        }
    
        return View::render('timbre/create', [
            'timbre' => $data,
            'errors' => $validator->getErrors(),
            'pays' => (new Pays)->select(),
            'certifications' => (new Certification)->select(),
            'etats' => (new EtatTimbre)->select(),
            'utilisateurs' => (new Utilisateur)->select()
        ]);
    }

    public function edit($query) {
        $timbre = (new Timbre)->find($query['id']);
        $image = (new Image)->where('timbre_id', $timbre->id);
        $timbre->image = $image ? $image->image_principale : null;

        return View::render('timbre/edit', [
            'timbre' => $timbre,
            'errors' => [],
            'pays' => (new Pays)->select(),
            'certifications' => (new Certification)->select(),
            'etats' => (new EtatTimbre)->select(),
            'utilisateurs' => (new Utilisateur)->select()
        ]);
    }

    public function update($data) {
        $validator = new Validator;
        $validator->field('nom', $data['nom'])->required()->min(2);
        $validator->field('description', $data['description'])->required();
        $validator->field('annee', $data['annee'])->required()->min(4)->max(4);
        $validator->field('pays_id', $data['pays_id'])->required();
        $validator->field('certification_id', $data['certification_id'])->required();
        $validator->field('etat_timbre_id', $data['etat_timbre_id'])->required();
        $validator->field('utilisateur_id', $data['utilisateur_id'])->required();

        if ($validator->isSuccess()) {
            //Ordre des paramètres
            (new Timbre)->update($data['id'], $data);

            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $imageName = uniqid() . '_' . $_FILES['image']['name'];
                $targetPath = 'public/assets/img/timbres/' . $imageName;
                move_uploaded_file($_FILES['image']['tmp_name'], $targetPath);

                $imageModel = new Image;
                $existing = $imageModel->where('timbre_id', $data['id']);

                if ($existing) {
                    //Ordre des paramètres
                    $imageModel->update($existing->id, ['image_principale' => $imageName]);
                } else {
                    $imageModel->insert(['image_principale' => $imageName, 'timbre_id' => $data['id']]);
                }
            }

            return View::redirect('timbre');
        }

        return View::render('timbre/edit', [
            'timbre' => $data,
            'errors' => $validator->getErrors(),
            'pays' => (new Pays)->select(),
            'certifications' => (new Certification)->select(),
            'etats' => (new EtatTimbre)->select(),
            'utilisateurs' => (new Utilisateur)->select()
        ]);
    }

    public function delete($query) {
        (new Timbre)->delete($query['id']);
        return View::redirect('timbre');
    }
}
