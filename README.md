# ostukorv
Avaneb index.php lehel, kus on andmebaasiga seotud kaupluse sisu. Saab valida tooted klikates nupule osta.

Lisatakse add-to-order.php lehe kaudu ostukorvi, mis nähtav nii index.php lehel kui ka order.php lehel. 
Tooteid saab kauplusesse lisada insert.php lehe kaudu.

Order.php lehelt suunatakse maksma. Makselahendus SEB panga lingile pay_seb.php.
Makselahendus Swedbank lingile pay.php lehel.

Edukas makse suunatakse success.php lehele ja tellimus loetakse täidetuks ja kustutatakse. 
Vigane makse suunatakse tagasi order.php lehele uuesti maksma.
