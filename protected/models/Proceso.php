<?php

/**
 * This is the model class for table "proceso".
 *
 * The followings are the available columns in table 'proceso':
 * @property integer $k_idProceso
 * @property integer $k_idCreador
 * @property integer $fk_idEstado
 * @property string $n_descripcion
 * @property integer $o_flagLeido
 *
 * The followings are the available model relations:
 * @property Paquetematenimiento[] $paquetematenimientos
 * @property Users $kIdCreador
 * @property Estados $fkIdEstado
 */
class Proceso extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Proceso the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'proceso';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('k_idTecnico, fk_idEstado', 'required'),
			array('k_idTecnico, fk_idEstado, o_flagLeido', 'numerical', 'integerOnly'=>true),
			array('n_descripcion', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('k_idProceso, k_idTecnico, fk_idEstado, n_descripcion, o_flagLeido', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'paquetematenimientos' => array(self::HAS_MANY, 'Paquetematenimiento', 'k_idProceso'),
			'kIdCreador' => array(self::BELONGS_TO, 'Users', 'k_idTecnico'),
			'fkIdEstado' => array(self::BELONGS_TO, 'Estados', 'fk_idEstado'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'k_idProceso' => 'Proceso',
			'k_idTecnico' => 'Tecnico',
			'fk_idEstado' => 'Estado',
			'n_descripcion' => 'Descripcion',
			'o_flagLeido' => 'Leido',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('k_idProceso',$this->k_idProceso);
		$criteria->compare('k_idTecnico',$this->k_idTecnico);
		$criteria->compare('fk_idEstado',$this->fk_idEstado);
		$criteria->compare('n_descripcion',$this->n_descripcion,true);
		$criteria->compare('o_flagLeido',$this->o_flagLeido);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}