<?php

/**
 * This is the model class for table "products".
 *
 * The followings are the available columns in table 'products':
 * @property integer $id
 * @property integer $type_id
 * @property integer $brand_id
 * @property integer $menu_id
 * @property string $name
 * @property string $url
 * @property string $images
 * @property string $key_features
 * @property integer $status
 */
class Products extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'products';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, url', 'required'),
			array('type_id, brand_id, status, last_updated', 'numerical', 'integerOnly'=>true),
			array('name, url, video_url', 'length', 'max'=>255),
			array('type_id, brand_id', 'validateIds'),
			array('url', 'customUrlValidate'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type_id, brand_id,  name, url, images, key_features, specifications, overview, status, last_updated', 'safe', 'on'=>'search'),
		);
	}
	// custom validate for ids
	public function validateIds($attribute, $params)
	{
		if(empty($this->type_id) && empty($this->brand_id) && empty($this->menu_id))
		$this->addError($attribute, 'You need to select types or brands.');
	}
	public function customUrlValidate($attr, $params)
	{
		$cat = Categories::model()->findByAttributes(array('url'=>$this->url));
		$subcat = SubCategories::model()->findByAttributes(array('url'=>$this->url));
		$brands = Brands::model()->findByAttributes(array('url'=>$this->url));
		$types = ProductType::model()->findByAttributes(array('url'=>$this->url));
		$product = Products::model()->findByAttributes(array('url'=>$this->url));
		if(isset($cat) || isset($subcat) || isset($brands) || isset($types) || (isset($product) && $product->id !=$this->id) )
			$this->addError($attr, $this->url.'" has already been taken.');
	}
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
				'types' => array(self::BELONGS_TO, 'ProductType', 'type_id'),
				'brands' => array(self::BELONGS_TO, 'Brands', 'brand_id'),
				'productDetails' => array(self::HAS_MANY, 'ProductDetails', 'product_id', 'condition'=>'productDetails.price > 0 '),
				'productPrice' => array(self::HAS_ONE, 'ProductDetails', 'product_id', 'order'=>'price ASC', 'condition'=>'price > 0'),
				'productReviews' => array(self::HAS_MANY, 'ProductReviews', 'product_id', 'condition'=>'verified = 1'),
				'wishlist' => array(self::STAT, 'Wishlist', 'product_id', 'condition'=>'user_id='.Yii::app()->user->id),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type_id' => 'Type',
			'brand_id' => 'Brand',
			'name' => 'Name',
			'url' => 'Url',
			'images' => 'Images',
			'key_features' => 'Key Features',
			'specifications'=>'Specifications',
			'overview'=>'Overview',
			'video_url'=>'Video Url',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->order = "id DESC";
		$criteria->condition="status=0";
		
		$criteria->compare('id',$this->id);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('brand_id',$this->brand_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('images',$this->images,true);
		$criteria->compare('key_features',$this->key_features,true);
		$criteria->compare('specifications',$this->specifications,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Products the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
