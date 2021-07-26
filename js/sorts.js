// если flag = false то сортировка DESC, true - ASC
document.addEventListener('DOMContentLoaded', () => {

    const getSort = ({ target }) => {
        const order = (target.dataset.order = -(target.dataset.order || 1));
        const index = [...target.parentNode.cells].indexOf(target);
        const collator = new Intl.Collator(['en', 'ru'], { numeric: true });
        const comparator = (index, order) => (a, b) => order * collator.compare(
            a.children[index].innerHTML,
            b.children[index].innerHTML
        );

        for(const tBody of target.closest('table').tBodies)
            tBody.append(...[...tBody.rows].sort(comparator(index, order)));

        for(const cell of target.parentNode.cells)
            cell.classList.toggle('sorted', cell === target);
    };

    document.querySelectorAll('th.sort').forEach(tableTH => tableTH.addEventListener('click', () => getSort(event)));

});
/**
 * первый способ
 * если flag = false то сортировка DESC, true - ASC
 * let flag = false
document.querySelector('#sort_date').onclick = sortOnDate;
document.querySelector('#sort_name').onclick = sortOnName;

function sortOnDate() {
    flag=!flag
    if (flag) {
        let sortedRows = Array.from(table.rows)
            .slice(1)
            .sort((rowA, rowB) => rowA.cells[2].innerHTML > rowB.cells[2].innerHTML ? 1 : -1);
        table.tBodies[0].append(...sortedRows);
    } else {
        let sortedRows = Array.from(table.rows)
            .slice(1)
            .sort((rowA, rowB) => rowA.cells[2].innerHTML > rowB.cells[2].innerHTML ? -1 : 1);
        table.tBodies[0].append(...sortedRows);
    };
}

function sortOnName() {
    flag=!flag
    if (flag) {
        let sortedRows = Array.from(table.rows)
            .slice(1)
            .sort((rowA, rowB) => rowA.cells[1].innerHTML > rowB.cells[1].innerHTML ? 1 : -1);
        table.tBodies[0].append(...sortedRows);
       // document.getElementById('sort_name').textContent = ' ↑'
    } else {
        let sortedRows = Array.from(table.rows)
            .slice(1)
            .sort((rowA, rowB) => rowA.cells[1].innerHTML > rowB.cells[1].innerHTML ? -1 : 1);
        table.tBodies[0].append(...sortedRows);
        //document.getElementById('sort_name').textContent = ' ↓'
    };
}**/
