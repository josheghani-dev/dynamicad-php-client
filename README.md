Hey, this is Anetwork Dynamicad PHP client, if you want to test our REST API or want to use it as fast as possible this package is for you, with this package you can simply fetch your products, update them, delete them and finally manage your products logo. here is how we do it.

# Installation
Add the package to your composer

```
composer require anetwork/dynamicad-php-client
```

If you are using composer supported frameworks like Laravel then you are ready to use the package, otherwise require composer autoloader in your main project file:

```
require_once( 'vendor/autoload.php' );
```

## Usage
Use this namespace and start working:

```
use Anetwork\Dynamicad\Client;
```

# Manage products
You can manage your products in this part, you can insert, update, delete or get the products list in here.

# Get
This method returns your products list and let you limit the results.

```
// return all products, limit them to 1000 items per request
Client::products()->get();

// return product with id equals to 1
Client::products()->id(1)->get();

// return product which limited to 10 and offset 2
Client::products()->limit(10, 2)->get();
```

# Insert
Following Dynamicad structure you should post ```id```, ```title```, ```image``` and ```url``` as required fields:

```
$data = [
     'id' => 'abc',
     'title' => 'this is title',
     'url' => 'http://google.com',
     'image' => 'http://i.telegraph.co.uk/multimedia/archive/03589/Wellcome_Image_Awa_3589699k.jpg',
     'visibility' => '1',
     'logo' => '451',
     'price' => '20000',
     'discount' => '180000'
   ];

Client::product()->post( $data );
```

## troubleshooting

| Error | Descriptions | Solution |
| --- | --- | --- |
| 017 | Logo does not exist! | You should add new logo yo DynamicAd which explained in [this](https://github.com/anetwork/dynamicad-php-client#insert-1) part.

# Update
You can also update your products with ```id```, ```title```, ```image``` and ```url``` as required fields:

```
$data = [
     'id' => 'abc',
     'title' => 'this is title',
     'url' => 'http://google.com',
     'image' => 'http://i.telegraph.co.uk/multimedia/archive/03589/Wellcome_Image_Awa_3589699k.jpg'
   ];

Client::product()->update( $data );
```

# Delete
And you can simply delete your product with product ```id```:

```
Client::product()->delete( 1 );
```

# Manage logos

You can manage your products logos in this part, you can insert, update, delete or get the logos list in here.

# Get
This method returns your products logos list and let you limit the results.

```
// return all logos, limit them to 1000 items per request
Client::logo()->get();

// return logo with id equals to 1
Client::logo()->id(1)->get();

// return logos which limited to 10 and offset 2
Client::logo()->limit(10,2)->get();
```

# Insert
You should post  ```image``` as required field:

```
$data = [
     'image' => 'http://i.telegraph.co.uk/multimedia/archive/03589/Wellcome_Image_Awa_3589699k.jpg',
     'default' => '1'
   ];

Client::logo()->post( $data );
```

# Update
You can also update your products with ```id``` as required field:

```
$data = [
     'id' => 'abc',
     'default' => '1',
     'image' => 'http://i.telegraph.co.uk/multimedia/archive/03589/Wellcome_Image_Awa_3589699k.jpg'
   ];

Client::logo()->update( $data );
```

# Delete
And you can simply delete your product with product ```id```:

```
Client::logo()->delete( 1 );
```
