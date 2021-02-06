<?php
namespace App\Models;

use App\Interfaces\Model;
use Carbon\Carbon;
use Exception;
use JsonSerializable;

final class Municipio extends AbstractDBConnection implements Model, JsonSerializable
{
    private ?int $id;
    private string $nombre;
    private int $departamentos_id;
    private string $acortado;
    private string $estado;
    private Carbon $created_at;
    private Carbon $updated_at;
    private Carbon $deleted_at;

    /* Relaciones */
    private ?Departamento $departamento;

    /**
     * Municipio constructor. Recibe un array asociativo
     * @param array $municipio
     * @throws Exception
     */
    public function __construct(array $municipio = [])
    {
        parent::__construct();
        $this->setId($municipio['id'] ?? NULL);
        $this->setNombre($municipio['nombre'] ?? '');
        $this->setDepartamentosId($municipio['departamentos_id'] ?? 0);
        $this->setAcortado($municipio['acortado'] ?? '');
        $this->setEstado($municipio['estado'] ?? '');
        $this->setCreatedAt(!empty($municipio['created_at']) ? Carbon::parse($municipio['created_at']) : new Carbon());
        $this->setUpdatedAt(!empty($municipio['updated_at']) ? Carbon::parse($municipio['updated_at']) : new Carbon());
        $this->setDeletedAt(!empty($municipio['deleted_at']) ? Carbon::parse($municipio['deleted_at']) : new Carbon());
    }

    public function __destruct()
    {
        if($this->isConnected){
            $this->Disconnect();
        }
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Municipio
     */
    public function setId(?int $id): Municipio
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     * @return Municipio
     */
    public function setNombre(string $nombre): Municipio
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return int
     */
    public function getDepartamentosId(): int
    {
        return $this->departamentos_id;
    }

    /**
     * @param int $departamentos_id
     */
    public function setDepartamentosId(int $departamentos_id): void
    {
        $this->departamentos_id = $departamentos_id;
    }

    /**
     * @return string
     */
    public function getAcortado(): string
    {
        return $this->acortado;
    }

    /**
     * @param string $acortado
     */
    public function setAcortado(string $acortado): void
    {
        $this->acortado = $acortado;
    }

    /**
     * @return string
     */
    public function getEstado(): string
    {
        return $this->estado;
    }

    /**
     * @param string $estado
     */
    public function setEstado(string $estado): void
    {
        $this->estado = $estado;
    }

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->created_at->locale('es');
    }

    /**
     * @param Carbon $created_at
     */
    public function setCreatedAt(Carbon $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return Carbon
     */
    public function getUpdatedAt(): Carbon
    {
        return $this->updated_at->locale('es');
    }

    /**
     * @param Carbon $updated_at
     */
    public function setUpdatedAt(Carbon $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return Carbon
     */
    public function getDeletedAt(): Carbon
    {
        return $this->deleted_at->locale('es');
    }

    /**
     * @param Carbon $deleted_at
     */
    public function setDeletedAt(Carbon $deleted_at): void
    {
        $this->deleted_at = $deleted_at;
    }

    /**
     * Relacion con departamento
     *
     * @return Departamento
     */
    public function getDepartamento(): ?Departamento
    {
        if(!empty($this->departamentos_id)){
            $this->departamento = Departamento::searchForId($this->departamentos_id) ?? new Departamento();
            return $this->departamento;
        }
        return null;
    }

    static function search($query): ?array
    {
        try {
            $arrMunicipios = array();
            $tmp = new Municipio();
            $tmp->Connect();
            $getrows = $tmp->getRows($query);
            $tmp->Disconnect();

            foreach ($getrows as $valor) {
                $Municipio = new Municipio($valor);
                array_push($arrMunicipios, $Municipio);
                unset($Municipio);
            }
            return $arrMunicipios;
        } catch (Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
        return null;
    }

    static function getAll(): array
    {
        return Municipio::search("SELECT * FROM dbindalecio.municipios");
    }

    static function searchForId(int $id): ?object
    {
        try {
            if ($id > 0) {
                $tmpMun = new Municipio();
                $tmpMun->Connect();
                $getrow = $tmpMun->getRow("SELECT * FROM dbindalecio.municipios WHERE id =?", array($id));
                $tmpMun->Disconnect();
                return ($getrow) ? new Municipio($getrow) : null;
            }else{
                throw new Exception('Id de municipio Invalido');
            }
        } catch (Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
        return null;
    }

    public function __toString() : string
    {
        return "Nombre: $this->nombre, Estado: $this->estado";
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'departamento_id' => $this->getDepartamento()->jsonSerialize(),
            'acortado' => $this->getAcortado(),
            'estado' => $this->getEstado(),
            'created_at' => $this->getCreatedAt()->toDateTimeString(),
            'updated_at' => $this->getUpdatedAt()->toDateTimeString(),
            'deleted_at' => $this->getDeletedAt()->toDateTimeString(),
        ];
    }

    protected function save(string $query): ?bool { return null; }
    function insert(){ }
    function update() { }
    function deleted() { }
}