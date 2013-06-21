<?php

/**
 * This is the model class for table "servicioproducto".
 *
 * The followings are the available columns in table 'servicioproducto':
 * @property integer $k_servicio
 * @property integer $k_producto
 */
class Servicioproducto extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Servicioproducto the static model class
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
		return 'servicioproducto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('k_servicio, k_producto', 'required'),
			array('k_servicio, k_producto', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('k_servicio, k_producto', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'k_servicio' => 'K Servicio',
			'k_producto' => 'K Producto',
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

		$criteria->compare('k_servicio',$this->k_servicio);
		$criteria->compare('k_producto',$this->k_producto);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}