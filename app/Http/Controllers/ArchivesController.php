<?php

namespace SgcAdmin\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use SgcAdmin\Repositories\ArchiveRepository;

class ArchivesController extends Controller
{
    private $breadcrumbs;
    /**
     * @var ArchiveRepository
     */
    private $archiveRepository;

    /**
     * ArchivesController constructor.
     * @param ArchiveRepository $archiveRepository
     */
    public function __construct(ArchiveRepository $archiveRepository)
    {
        $this->breadcrumbs = [
            'title' => 'Arquivos',
            'page' => 'Registros',
            'fa' => 'fa-file-text-o'
        ];

        $this->archiveRepository = $archiveRepository;
    }

    public function index($id)
    {
        $this->breadcrumbs = [
            'title' => 'Arquivos - Contrato: '.$id,
            'page' => 'Registros',
            'fa' => 'fa-file-text-o'
        ];

        $archives = $this->archiveRepository->findWhere([['contract_id', '=', $id]]);
        $contractId = $id;
        return view('admin.archives.index',
            $this->breadcrumbs,
            compact(
                'archives',
                'contractId'
            )
        );
    }

    public function store($id)
    {
        // A list of permitted file extensions
        $allowed = array('*');
        $path = 'assets/admin/storage/';
        $directory = md5($id.uniqid());
        File::makeDirectory($path.$directory.'/', 0775, true, true);

        if(Request::ajax()){
            if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){
                $extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

                $fileName = uniqid();
                if(move_uploaded_file($_FILES['upl']['tmp_name'], $path.$directory.'/'.$fileName.'.'.$extension)){
                    $data = [
                        'name' => $_FILES['upl']['name'],
                        'path' => $fileName.'.'.$extension, 'contract_id' => $id,
                        'directory' => $directory
                    ];

                    $this->archiveRepository->create($data);
                    exit;
                }
            }
            echo '{"status":"error"}';
            exit;
        }
    }

    public function destroy($id, $contractId)
    {
        $archive = $this->archiveRepository->find($id);

        $addressFile = 'assets/admin/storage/'.$archive['directory'].'/'.$archive['path'];
        $directory = 'assets/admin/storage/'.$archive['directory'];

        if (Storage::exists($addressFile))
        {
            Storage::delete($addressFile);
            Storage::delete($directory);
        }

        $this->archiveRepository->delete($archive['id']);

        return redirect()->route('admin.archive.index', ['id' => $contractId]);
    }
}
