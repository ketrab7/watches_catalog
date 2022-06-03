<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Instrukcja katalogu zegarków</title>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-2">
            <div>
                <h4>Spis treści:</h4>
                <a class="btn" href="#1">1. Pobranie nowych aktualizacji.</a></br>
                <a class="btn" href="#2">2. Model: dodawanie, aktualizacja i usuwanie.</a></br>
                <a class="btn" href="#3">3. Produkt: dodawanie, aktualizacja, usuwanie i wyszukiwanie produktów.</a></br>
                <a class="btn" href="#4">4. Paginacja</a>
            </div>

            <hr/>
            <div id="1" class="mt-4">
                <h4>1. Pobranie nowych aktualizacji.</h4>
                <div>
                    Na początku należy uruchomić XAMPP. 
                    Aby poprawnie go uruchomić w polach Apache i MySQL należy kliknąć start.
                </div>
                <img src="{{ asset('help/xampp.png') }}" alt="xampp">
                <div>
                    Aby pobrać nowe aktualizacje należy uruchomić program Visual Studio Code. 
                    Następnie w polu terminal wpisać:
                </div>
                <img src="{{ asset('help/git-pull.png') }}" alt="git-pull" width=1300>
                Komenda: <i>git pull</i></br>
                <span style="color:red">Ważne! Aby wszystko poprawnie zadziałało musi być dostęp do internetu.</span>
                <div>
                    W przypadku problemu z wyświetlaniem aplikacji na stronie, należy wyczyścić pamięć cache (Ctrl + Shift + R)
                </div>
            </div>

            <hr/>
            <div id="2" class="mt-4">
                <h4>2. Model: dodawanie, aktualizacja i usuwanie.</h4>
                <div>
                    Model jest to grupa produktów, która występuje pod tą samą marką.
                    Model jest to pierwszy element wyświetlany na stronie. Widok:
                </div>
                <img src="{{ asset('help/model-view.png') }}" alt="model-view" width=1300>
                <div>
                    Aby łatwo wrócić do strony startowej, wystarczy nacisnąć w katalog produktów w lewym górnym rogu.
                </div>
                <div>
                    Aby dodać nowy model, należy nacisnąć w lewym górnym rogu przycisk <i>Dodaj</i>.
                    Po naciśnięciu pokazuje się modal:
                </div>
                <img src="{{ asset('help/model-modal.png') }}" alt="model-modal" width=1300>
                <div>
                    Nie jest ustawiona żadna walidacja dla wszystkich pól. 
                    Każdy element może być pusty a model poprawnie się zapisze. 
                    Jedyne ograniczenia:</br>
                    -nazwa modelu maksymalnie do 255 znaków.</br>
                    -opis krótki maksymalnie do 255 znaków.</br>
                    -opis długi maksymalnie do 65 535 znaków.</br>
                    -zdjęcie automatycznie się skaluje do wymiaru 200x200px. 
                    Może być przechowywane tylko 1. W przypadku gdy zdjęcie jest mniejsze 
                    nie zostanie ono rozciągnięte a jedynie dodane przeźroczyste tło (w przypadku plików .png).</br>
                    Po naciśnięciu przycisku model zostanie dodany do bazy danych 
                    a aplikacja przekieruje użytkownika na stronę startową.
                </div>
                <div class="mt-1">
                    Aby zaktualizować model należy na wybranej karcie rozwinąć listę i wybrać opcję <i>Edytuj</i>
                </div>
                <img src="{{ asset('help/model-edit-button.png') }}" alt="model-edit-button" width=1300>
                <div>
                    Po przejściu wyświetli się formularz do aktualizacji modelu.
                </div>
                <img src="{{ asset('help/model-edit.png') }}" alt="model-edit" width=1300>
                <div>
                    W nim można podejrzeć ID a także datę dodania i datę ostaniej aktualizacji. 
                    Te pola są nie do edycji.
                    Pozostałe pola można nadpisywać a zmiany zostaną zaktualizowane po kliknięciu w przycisk <i>Zapisz</i>.
                    </br><b>Ważne!</b></br>
                    Po dodaniu nowego zdjęcia stare usunię się z dysku i zostanie zastąpione nowym, 
                    jeżeli użytkownik nie chce zmieniać zdjęcia, należy pozostawić puste a dane nie zostaną usunięte.
                    W przypadku nie nadpisywania modelu z lewej strony znajduje się przycisk do powrotu na listę modeli.
                </div>
                <div>
                    W liście rozwijanej znajduje się przycisk usunięcia modelu. 
                    Po kliknięciu w niego wyświetli się alert z potwierdzeniem decyzji. 
                    W przypadku zaakceptowania model zostanie usunięty nieodwracalnie.
                    Jeżeli pod modelem znajdują się zdjęcia <i>System</i> zwróci komunikat o wcześniejszym usunięciu produktów z bazy.
                </div>
                <img src="{{ asset('help/model-delete.png') }}" alt="model-delete" width=1300>
            </div>

            <hr/>
            <div id="3">
                <h4>3. Produkt: dodawanie, aktualizacja, usuwanie i wyszukiwanie produktów.</h4>
                <div>
                    Produkt jest drugim elementem wyświetlanym na stronie internetowej, 
                    aby przejść do niego należy kliknąć na obrazek pojedynczego modelu.
                </div>
                <img src="{{ asset('help/product-view.png') }}" alt="product-view" width=1300>
                <div>
                    Aby dodać nowy produkt należy kliknąć w lewym górnym rogu przycisk <i>Dodaj nowy produkt</i>.
                    Przekieruje on do osobnej strony w której nalezy uzupełnić poszczególne dane:
                </div>
                <img src="{{ asset('help/product-create.png') }}" alt="product-create" width=1300>
                <div>
                    Nie jest ustawiona żadna walidacja dla wszystkich pól. 
                    Każdy element może być pusty a produkt poprawnie się zapisze. 
                    Jedyne ograniczenia:</br>
                    -produkt może mieć tylko jeden model.</br>
                    -nazwa znamionowa może mieć maksymalnie do 255 znaków.</br>
                    -mechanizm może mieć maksymalnie do 255 znaków.</br>
                    -lata produkcji mogą mieć maksymalnie do 255 znaków.</br>
                    -szerokość koperty może mieć maksymalnie do 255 znaków.</br>
                    -szerokość uszu może mieć maksymalnie do 255 znaków.</br>
                    -wymiar ucho-ucho może mieć maksymalnie do 255 znaków.</br>
                    -szkło może mieć maksymalnie do 255 znaków.</br>
                    -liczba kamieni może mieć maksymalnie do 255 znaków.</br>
                    -płeć jest typem select i może przyjąć trzy wartości: męski, damski, dla obu płci</br>
                    -opis szczegółowy może mieć maksymalnie do 65 535 znaków.</br>
                    -zdjęcia są automatycznie skalowane do wymiaru 1000x1000px. 
                    Zdjęcia przechowywane są w osobnej tabeli. Dzięki temu można zarządzać ilością zdjęć dla produktu.
                    W przypadku gdy zdjęcie jest mniejsze  nie zostanie ono rozciągnięte a jedynie dodane 
                    przeźroczyste tło (w przypadku plików .png).</br>
                    Po naciśnięciu przycisku produkt zostanie dodany do bazy danych 
                    a aplikacja przekieruje użytkownika na stronę z listą produktów.
                </div>
                <div class="mt-1">
                    Aby podglądnąć kartę produktu należy nacisnąć w zdjęcie. Przekieruje ono do osobnej strony:
                </div>
                <img src="{{ asset('help/product-card.png') }}" alt="product-card" width=1300>
                <div class="mt-1">
                    Elementy wyświetlane z prawej strony będą ukryte w przypadku nie uzupełnienia ich.
                    Z lewej strony znajduje się zdjęcie, poniżej są miniaturki, po kliknięciu w wybraną miniaturkę 
                    zmieni się główny obraz na wybraną. 
                    Po kliknięciu w zdjęcie otworzy się nowa zakładka ze zdjęciem w pełnej rozdzielczości.
                    Na dole wyświetlane są dwa opisy: opis długi z modelu i opis szczegółowy z produktu.
                </div>
                <div class="mt-1">
                    Aby zaktualizować produkt, można w taki sam sposób przejść do jego edycji jak w modelu, 
                    ale również z karty produktu możemy wybrać <i>Edytuj produkt</i>.
                    Po kliknięciu aplikacja przekieruje nas do strony ze zmianą produktu. 
                </div>
                <img src="{{ asset('help/product-edit.png') }}" alt="product-edit" width=1300>
                <div class="mt-1">
                    Funkcjonalność edycji produktu działa tak samo jak edycji modelu. 
                    Poniżej formularza z edycją produktu znajduje się drugi formularz z możliwością usuwania pojedynczych zdjęć.
                </div>
                <img src="{{ asset('help/product-edit-deleteImage.png') }}" alt="product-edit-deleteImage" width=1300>
                <div>
                    W liście rozwijanej znajduje się przycisk usunięcia produktu. 
                    Możemy również usunąć produkt z karty produktowej. Po kliknięciu wyświetli się alert 
                    z potwierdzeniem decyzji. W przypadku zaakceptowania produkt zostanie usunięty nieodwracalnie
                    wraz z wszystkimi zdjęciami.
                </div>
            </div>

            <hr/>
            <div id="4">
                <h4>4. Paginacja</h4>
                <div>
                    Paginacja jest to zwracanie ilości kart wyświetlanych na jednej stronie. 
                    Domyślnie paginacja ustawiona jest na 6 pozycji. Aby ją zmienić wystarczy wpisać ilość kart na stronie 
                    a następnie nacisnąć w przycisk <i>zmień</i>.
                </div>
                <img src="{{ asset('help/pagination-edit.png') }}" alt="pagination-edit" width=1300>
            </div>
        </div>
    </body>
</html>