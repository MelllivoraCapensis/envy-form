# envy-form
Типы хранилищ заявок - database, txt, json, csv

Для добавления нового типа файлового хранилища нужно 
- добавить в abstract class SaverFactory в STORAGE_TYPES новый тип
- создать новую фабрику для этого типа унаследовав от FileSaver
- создать новое хранилище унаследовав от FileStorage

Для изменения пути файлов-хранилищ можно либо
- переопределить путь в соответствующей фабрике в конструкторе через метод setPath
- либо в процессе сохранения заявки задать новый путь SaverFactory::getSaver($storage_type)->setPath($new_path)->getStorage()->add($request)
- при вызове setPath у DatabaseSaver метод ни на что не повлияет

Файл config.php содержит класс с параметрами для подключения к базе данных, базовую директорию хранения файлов (/data)
Дамп базы request.sql

Деплой приложения http://envy-form.tw1.ru/
