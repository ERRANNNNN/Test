Задачи с 1 по 4 находятся в файле ArrayController (структура в файле = структура контроллера Laravel)
Каждую из задач сделал двумя способами, с использованием коллекций и с использованием встроенных php функций

5 задача

SELECT goods.id, goods.name FROM `goods`
LEFT JOIN goods_tags ON goods.id = goods_tags.goods_id
GROUP BY goods.id, goods.name
HAVING COUNT(DISTINCT goods_tags.tag_id) = (SELECT COUNT(tags.id) FROM tags);

6 задача

SELECT department_id, COUNT(gender) as gender_count, SUM(gender) as gender_sum FROM `respondents_departments`
GROUP BY department_id
HAVING (COUNT(gender) = SUM(gender)) AND (MIN(value) > 5);

Задачи по архитектуре в соотвтетствующих файлах, как я понял был ещё файл concept.php (видимо который должен был быть
связан с solid_d.php), но я его заметил уже после того как сделал задачу (по-своему).
