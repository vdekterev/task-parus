function fetchData() {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const tableBody = document.querySelector('.tableBody');

            if (this.responseText === ''){
                return;
            }
            let formattedData = formatData(this.responseText);
            console.log(formattedData)
            tableBody.innerHTML = formattedData + tableBody.innerHTML;
        }
    };
    xhttp.open("GET", "http://localhost/task-parus/trades/updatetrades", true);
    xhttp.send();
}


// Вызываем fetchData каждые 5 секунд
setInterval(fetchData, 5000);

function formatData(response) {
    let trades = JSON.parse(response)
    let newTrades = '';
    trades.forEach((d) => newTrades +=
    `<tr>
        <th scope="row">
        <a href="https://fedresurs.ru/bidding/${d.guid}" target="_blank">${d.num}
        </a></th>
        <td>${d.lot}</td>
        <td>${d.place}</td>
        <td>${d.type}</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
   </tr>`)

    return newTrades;
}