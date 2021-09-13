import $ from'jquery';

$(document).ready(function() {
    'use strict'

    const BASE_URL = 'http://127.0.0.1:8001/api/v1';
    const CURRENT_BALANCE = `${BASE_URL}/user/balance/current`;
    const BALANCE_HISTORY = `${BASE_URL}/user/balance/history`;

    let myHeaders = new Headers();
    myHeaders.append("Accept", "application/json");
    myHeaders.append("Content-Type", "application/json");

    let balanceHistory = JSON.stringify({
        "jsonrpc": "2.0",
        "method": "balance@history",
        "params": {
            "email": "test@test.com"
        },
        "id": 1
    });

    let balanceHistorySettings = {
        method: 'POST',
        headers: myHeaders,
        body: balanceHistory
    };

    fetch(BALANCE_HISTORY, balanceHistorySettings)
        .then(response => response.json())
        .then(function(data) {
            let operations = data.result;
            let reversed = Object.keys(data.result).reverse();
            $.each(reversed, function(i, key) {
                $('#balanceHistory').append('<tr>' +
                    '<td>' + operations[key].value+ '</td>' +
                    '<td>' + operations[key].balance + '</td>' +
                    '<td>' + operations[key].created_at.time + '</td>' +
                    '<td>' + operations[key].created_at.date + '</td>' +
                    + '</tr>');
            });
        })
        .catch(error => console.log('error', error));

    let currentBalance = JSON.stringify({
        "jsonrpc": "2.0",
        "method": "balance@userBalance",
        "params": {
            "email": "test@test.com"
        },
        "id": 1
    });

    let currentBalanceSettings = {
        method: 'POST',
        headers: myHeaders,
        body: currentBalance,
    };

    fetch(CURRENT_BALANCE, currentBalanceSettings)
        .then(response => response.json())
        .then(function(data) {
            $('#currentBalance').append(data.result);
        })
        .catch(error => console.log('error', error));
});
