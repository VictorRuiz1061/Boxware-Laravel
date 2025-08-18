<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    protected $primaryKey = 'id_modulo';
    public $timestamps = false;
    
    protected $fillable = [
        'rutas',
        'descripcion_ruta',
        'imagen',
        'estado',
        'es_submenu',
        'modulo_padre_id',
        'fecha_accion',
        'fecha_creacion'
    ];
    
    // Accesor para mantener compatibilidad con el código existente
    public function getNombreAttribute()
    {
        return $this->descripcion_ruta;
    }
    
    // Accesor para la ruta
    public function getRutaAttribute()
    {
        return $this->rutas;
    }
    
    // Relación con los permisos
    public function permisos()
    {
        return $this->hasMany(Permiso::class, 'modulo_id', 'id_modulo');
    }
    
    // Relación consigo mismo para los submódulos
    public function submodulos()
    {
        return $this->hasMany(Modulo::class, 'modulo_padre_id', 'id_modulo')
                   ->where('estado', 1)
                   ->orderBy('fecha_creacion', 'asc');
    }
    
    // Relación con el módulo padre
    public function moduloPadre()
    {
        return $this->belongsTo(Modulo::class, 'modulo_padre_id', 'id_modulo');
    }
    
    // Obtener solo módulos principales (sin padre)
    public static function modulosPrincipales()
    {
        return self::whereNull('modulo_padre_id')
                  ->where('estado', 1)
                  ->orderBy('fecha_creacion', 'asc')
                  ->get();
    }
}
