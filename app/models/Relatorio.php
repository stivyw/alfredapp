<?php

class Relatorio extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'type' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['status','type','ids','email_id'];


	public function get_despesas(){
        //return $this->hasMany('Despesa', 'ids');
        $despesas = explode(',', $this->ids);
        $despesas = Despesa::whereIn('id',$despesas)->get();
        return $despesas;
    }

    public function conversas(){
        return $this->hasMany('Conversa');
    }

    public function emails(){
        return $this->hasMany('Email', 'resource_id')->where('resource_name','relatorio')->get();
    }


    public function getAttachment()
    {
        $attachment = "pdf/relatorios/relatorio-".$this->id."_".$this->type.".pdf";               
        if( is_file( $attachment ) ){
            return $attachment;
        } else {
            return NULL; 
        }
    }

}