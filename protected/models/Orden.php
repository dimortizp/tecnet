<?php

/**
 * This is the model class for table "orden".
 *
 * The followings are the available columns in table 'orden':
 * @property integer $k_idOrden
 * @property integer $k_idUsuario
 *
 * The followings are the available model relations:
 * @property CrugeUser $kIdUsuario
 * @property Paquetematenimiento[] $paquetematenimientos
 */
class Orden extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Orden the static model class
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
		return 'orden';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('k_idUsuario', 'required'),
			array('k_idUsuario', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('k_idOrden, k_idUsuario', 'safe', 'on'=>'search'),
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
			'kIdUsuario' => array(self::BELONGS_TO, 'CrugeUser', 'k_idUsuario'),
			'paquetematenimientos' => array(self::HAS_MANY, 'Paquetematenimiento', 'k_idOrden'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'k_idOrden' => 'Orden',
			'k_idUsuario' => 'Usuario',
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

		$criteria->compare('k_idOrden',$this->k_idOrden);
		$criteria->compare('k_idUsuario',$this->k_idUsuario);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}