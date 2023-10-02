<?php

namespace App\Services;


use Illuminate\Support\Facades\File;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Contracts\Foundation\Application;

class MakeViewsService
{
    use InteractsWithIO;

    public PathsAndNamespacesService $pathsAndNamespacesService;
    public function __construct(
        PathsAndNamespacesService $pathsAndNamespacesService,
        ConsoleOutput $consoleOutput,
        Application $application
    )
    {
        $this->pathsAndNamespacesService = $pathsAndNamespacesService;
        $this->output = $consoleOutput;
        $this->laravel = $application->getNamespace();
    }

    public function createDirectoryViews($namingConvention)
    {
        $directoryName = $this->pathsAndNamespacesService->getRealpathBaseCustomViews($namingConvention);
        // if the directory doesn't exist we create it
        if (!File::isDirectory($directoryName))
        {
            File::makeDirectory($directoryName, 0755, true);
            $this->line("<info>Created views directory:</info> ".$namingConvention['plural_low_name']);
        }
        else
            $this->error('Views directory '.$namingConvention['plural_low_name'].' already exists');
    }

    public function replaceContentControllerStub($namingConvention, $laravelNamespace)
    {
        $controllerStub = File::get($this->pathsAndNamespacesService->getControllerStubPath());
        $controllerStub = str_replace('DummyClass', $namingConvention['plural_name'].'Controller', $controllerStub);
        $controllerStub = str_replace('DummyModel', $namingConvention['singular_name'], $controllerStub);
        $controllerStub = str_replace('DummyVariableSing', $namingConvention['singular_low_name'], $controllerStub);
        $controllerStub = str_replace('DummyVariable', $namingConvention['plural_low_name'], $controllerStub);
        $controllerStub = str_replace('DummyNamespace', $this->pathsAndNamespacesService->getDefaultNamespaceController($laravelNamespace), $controllerStub);
        $controllerStub = str_replace('DummyRootNamespace', $laravelNamespace, $controllerStub);
        return $controllerStub;
    }

    public function findAndReplaceControllerPlaceholderColumns($columns, $controllerStub, $namingConvention)
    {
        $cols='';
        foreach ($columns as $column)
        {
            $type     = explode(':', trim($column));
            $column   = $type[0];

            // our placeholders
            $cols .= str_repeat("\t", 2).'DummyCreateVariableSing$->'.trim($column).'=$request->input(\''.trim($column).'\');'."\n";
        }

        // we replace our placeholders
        $controllerStub = str_replace('DummyUpdate', $cols, $controllerStub);
        $controllerStub = str_replace('DummyCreateVariable$', '$'.$namingConvention['plural_low_name'], $controllerStub);
        $controllerStub = str_replace('DummyCreateVariableSing$', '$'.$namingConvention['singular_low_name'], $controllerStub);

        return $controllerStub;
    }

    public function findAndReplaceIndexViewPlaceholderColumns($columns, $templateViewsDirectory, $namingConvention, $separateStyleAccordingToActions)
    {
        $thIndex=$indexView='';
        foreach ($columns as $column)
        {
            $type      = explode(':', trim($column));
            $column    = $type[0];
            if($type[1] === 'relasi'){
                $column = $type[2];
            }
            // our placeholders
            $thIndex    .=str_repeat("\t", 5).'<th class="text-center">'.ucwords(strtolower(trim($column)))."</th>\n";
        }

        $indexStub = File::get($this->pathsAndNamespacesService->getCrudgenViewsStubCustom($templateViewsDirectory).DIRECTORY_SEPARATOR.'index.stub');
        $indexStub = str_replace('DummyHeaderTable', $thIndex, $indexStub);
        $indexStub = str_replace('DummyExtends', $separateStyleAccordingToActions['index']['extends'], $indexStub);
        $indexStub = str_replace('DummySection', $separateStyleAccordingToActions['index']['section'], $indexStub);

        return $indexStub;
    }

    public function findAndReplaceTambahViewPlaceholderColumns($columns, $templateViewsDirectory, $namingConvention, $separateStyleAccordingToActions)
    {
        $formCreate='';
        foreach ($columns as $column)
        {
            $type      = explode(':', trim($column));
            $sql_type  = $type[1];
            $column    = $type[0];
            $typeHtml = $this->getHtmlType($sql_type);


            // our placeholders
            $formCreate .=str_repeat("\t", 2).'<p>'."\n";
            if($typeHtml === 'select'){
                $formCreate .=str_repeat("\t", 3).'{!! Form::label(\''.trim($column).'\', \'Pilih '.ucfirst(trim($column)).'\', [\'class\'=>\'control-label\']) !!}'."\n";
                $formCreate .=str_repeat("\t", 3).'{!! Form::'.$typeHtml.'(\''.trim($column).'\',$'.trim($column).', null, array(\'id\' => \''.trim($column).'\', \'class\' => \'form-control select2\', \'placeholder\'=>\'Pilih\')) !!}'."\n";
            }else{
                $formCreate .=str_repeat("\t", 3).'{!! Form::label(\''.trim($column).'\', \'Masukkan '.ucfirst(trim($column)).'\', [\'class\'=>\'control-label\']) !!}'."\n";
                $formCreate .=str_repeat("\t", 3).'{!! Form::'.$typeHtml.'(\''.trim($column).'\', null, array(\'id\' => \''.trim($column).'\', \'class\' => \'form-control\', \'autocomplete\' => \'off\')) !!}'."\n";
            }
            $formCreate .=str_repeat("\t", 2).'</p>'."\n";
        }

        $createStub = File::get($this->pathsAndNamespacesService->getCrudgenViewsStubCustom($templateViewsDirectory).DIRECTORY_SEPARATOR.'tambah.stub');
        $createStub = str_replace('DummyFormCreate', $formCreate, $createStub);
        return $createStub;
    }

    public function findAndReplaceHapusViewPlaceholderColumns($columns, $templateViewsDirectory, $namingConvention, $separateStyleAccordingToActions)
    {
        $formDelete='';
        $column = $columns[0];
            $type      = explode(':', trim($column));
            $sql_type  = $type[1];
            $column    = $type[0];
            
            // our placeholders
            $formDelete .=str_repeat("\t", 2).'<p>'."\n";
            $formDelete .=str_repeat("\t", 3).'<label class="control-label">Hapus data <strong>{{ $data->'.trim($column).' }}</strong>?</label>'."\n";
            $formDelete .=str_repeat("\t", 2).'</p>'."\n";
        
        $deleteStub = File::get($this->pathsAndNamespacesService->getCrudgenViewsStubCustom($templateViewsDirectory).DIRECTORY_SEPARATOR.'hapus.stub');
        $deleteStub = str_replace('DummyVariable', $formDelete, $deleteStub);

        return $deleteStub;
    }

    public function findAndReplaceUbahViewPlaceholderColumns($columns, $templateViewsDirectory, $namingConvention, $separateStyleAccordingToActions)
    {
        $formEdit='';
        foreach ($columns as $column)
        {
            $type      = explode(':', trim($column));
            $sql_type  = $type[1];
            $column    = $type[0];
            $typeHtml = $this->getHtmlType($sql_type);

            // our placeholders
            $formEdit .=str_repeat("\t", 2).'<p>'."\n";
            if($typeHtml === 'select'){
                $formEdit .=str_repeat("\t", 3).'{!! Form::label(\''.trim($column).'\', \'Pilih '.ucfirst(trim($column)).'\', [\'class\'=>\'control-label\']) !!}'."\n";
                $formEdit .=str_repeat("\t", 3).'{!! Form::'.$typeHtml.'(\''.trim($column).'\',$'.trim($column).', $data->'.trim($column).', array(\'id\' => \''.trim($column).'\', \'class\' => \'form-control select2\', \'placeholder\'=>\'Pilih\')) !!}'."\n";
            }else{
                $formEdit .=str_repeat("\t", 3).'{!! Form::label(\''.trim($column).'\', \'Masukkan '.ucfirst(trim($column)).'\', [\'class\'=>\'control-label\']) !!}'."\n";
                $formEdit .=str_repeat("\t", 3).'{!! Form::'.$typeHtml.'(\''.trim($column).'\', $data->'.trim($column).', array(\'id\' => \''.trim($column).'\', \'class\' => \'form-control\', \'autocomplete\' => \'off\')) !!}'."\n";
            }
            $formEdit .=str_repeat("\t", 2).'</p>'."\n";
        }

        $editStub = File::get($this->pathsAndNamespacesService->getCrudgenViewsStubCustom($templateViewsDirectory).DIRECTORY_SEPARATOR.'ubah.stub');
        $editStub = str_replace('DummyFormCreate', $formEdit, $editStub);
        return $editStub;
    }

    public function findAndReplaceDatatableViewPlaceholderColumns($columns, $templateViewsDirectory, $namingConvention, $separateStyleAccordingToActions)
    {
        $field='';
        foreach ($columns as $column)
        {
            $type      = explode(':', trim($column));
            $sql_type  = $type[1];
            $column    = $type[0];
            if($type[1] === 'relasi'){
                $column = $type[2].'.nama';
            }
            // our placeholders
            $field .=str_repeat("\t", 4).'{ data: \''.strtolower(trim($column)).'\' },'."\n";
        }

        $datatableStub = File::get($this->pathsAndNamespacesService->getCrudgenViewsStubCustom($templateViewsDirectory).DIRECTORY_SEPARATOR.'datatables.stub');
        $datatableStub = str_replace('Dummyfield', $field, $datatableStub);
        return $datatableStub;
    }
    
    public function findAndReplaceAjaxViewPlaceholderColumns($columns, $templateViewsDirectory, $namingConvention, $separateStyleAccordingToActions)
    {
        $ajaxStub = "";
        return $ajaxStub;
    }

    public function createFileOrError($namingConvention, $contentFile, $fileName)
    {
        if(!File::exists($this->pathsAndNamespacesService->getRealpathBaseCustomViews($namingConvention).DIRECTORY_SEPARATOR.$fileName))
        {
            File::put($this->pathsAndNamespacesService->getRealpathBaseCustomViews($namingConvention).DIRECTORY_SEPARATOR.$fileName, $contentFile);
            $this->line("<info>Created View:</info> ".$fileName);
        }
        else
            $this->error('View '.$fileName.' already exists');
    }

    private function getHtmlType($sql_type)
    {
        $conversion =
        [
            'string'  => 'text',
            'text'    => 'textarea',
            'integer' => 'text',
            'date'    => 'date',
            'select'  => 'select',
            'relasi'  => 'select'
        ];
        return (isset($conversion[$sql_type]) ? $conversion[$sql_type] : 'string');
    }
}
