// COD ledger arithmetic for the admin COD Settlements page.
// Plain functions with no Firestore or DOM, so they can be tested with node.
(function (root) {

    function toNumber(value) {
        var n = parseFloat(value);
        return isNaN(n) ? 0 : n;
    }

    // Money is stored with 2 decimals; rounding each sum keeps float noise
    // (0.1 + 0.2) out of Firestore and out of the totals.
    function round2(value) {
        return Math.round((toNumber(value) + Number.EPSILON) * 100) / 100;
    }

    // Unsettled totals for one driver's open ledger entries.
    function sumEntries(entries) {
        var totals = { orders: 0, collected: 0, commission: 0, netDue: 0 };
        entries.forEach(function (entry) {
            if (entry.type != 'opening_balance') {
                totals.orders++;
            }
            totals.collected += toNumber(entry.cashCollected);
            totals.commission += toNumber(entry.driverCommission);
            totals.netDue += toNumber(entry.netDue);
        });
        totals.collected = round2(totals.collected);
        totals.commission = round2(totals.commission);
        totals.netDue = round2(totals.netDue);
        return totals;
    }

    // full: the driver hands over all the cash; the wallet is not touched.
    // net:  the driver keeps their commission from the cash, and the same amount
    //       comes out of the earnings wallet, never taking it below zero.
    function settlementAmounts(totals, mode, walletAmount) {
        var walletDeducted = 0;
        if (mode == 'net') {
            walletDeducted = Math.min(totals.commission, Math.max(toNumber(walletAmount), 0));
            walletDeducted = round2(Math.max(walletDeducted, 0));
        }
        return {
            walletDeducted: walletDeducted,
            cashReceived: round2(totals.collected - walletDeducted)
        };
    }

    // Dashboard totals. openEntries are all unsettled ledger entries, settlements
    // all cod_settlements documents, drivers the driver user documents.
    function dashboardTotals(drivers, openEntries, settlements) {
        var earnings = 0;
        drivers.forEach(function (driver) {
            var wallet = toNumber(driver.wallet_amount);
            if (wallet > 0) {
                earnings += wallet;
            }
        });
        var open = sumEntries(openEntries);
        var settledCollected = 0;
        settlements.forEach(function (settlement) {
            settledCollected += toNumber(settlement.totalCollected);
        });
        return {
            driverEarnings: round2(earnings),
            collectedAllTime: round2(settledCollected + open.collected),
            dueFromDrivers: open.netDue,
            outstanding: open.collected
        };
    }

    var api = {
        toNumber: toNumber,
        round2: round2,
        sumEntries: sumEntries,
        settlementAmounts: settlementAmounts,
        dashboardTotals: dashboardTotals
    };
    if (typeof module !== 'undefined' && module.exports) {
        module.exports = api;
    } else {
        root.CodSettlementCalc = api;
    }
})(this);
