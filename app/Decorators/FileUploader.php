<?php namespace TGLD\Decorators;

use Laracasts\Commander\CommandBus;

class FileUploader implements  CommandBus
{

    /**
     * Execute a command
     *
     * @param $command
     * @return mixed
     */
    public function execute($command)
    {
        if(!is_null($command->file_url))
        {
            $file_name = $this->makeName($command);

            $command->file_url = $file_name;

            return $command;
        }
        else
        {
            $command->file_url = null;

            return $command;
        }
    }

    public function makeName($command)
    {
        return date("m.d.y") .'-'.  $command->file_url->getClientOriginalName();;
    }

    public function moveFile($command, $file_name)
    {
        $destination = base_path().'/public/media/file_uploads';

        $command->file_url->move($destination, $file_name);
    }
}