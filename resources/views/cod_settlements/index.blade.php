@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{ trans('lang.cod_settlements') }}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ trans('lang.dashboard') }}</a></li>
                    <li class="breadcrumb-item active">{{ trans('lang.cod_settlements') }}</li>
                </ol>
            </div>
            <div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="admin-top-section">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex top-title-section pb-4 justify-content-between">
                            <div class="d-flex top-title-left align-self-center">
                                <span class="icon mr-3"><img src="{{ asset('images/payment.png') }}"></span>
                                <h3 class="mb-0">{{ trans('lang.cod_settlements') }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="alert alert-warning cod_ledger_off" style="display: none;">
                {{ trans('lang.cod_ledger_off_warning') }}
                <a href="{{ url('settings/app/globals') }}">{{ trans('lang.cod_open_global_settings') }}</a>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="card card-box-with-icon bg--8">
                        <div class="card-body">
                            <h4 class="text-dark-2 mb-1 h4" id="total_driver_earnings">-</h4>
                            <p class="mb-0 small text-dark-2">{{ trans('lang.cod_total_driver_earnings') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-box-with-icon bg--1">
                        <div class="card-body">
                            <h4 class="text-dark-2 mb-1 h4" id="total_collected">-</h4>
                            <p class="mb-0 small text-dark-2">{{ trans('lang.cod_total_collected') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-box-with-icon bg--5">
                        <div class="card-body">
                            <h4 class="text-dark-2 mb-1 h4" id="total_due">-</h4>
                            <p class="mb-0 small text-dark-2">{{ trans('lang.cod_total_due') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-box-with-icon bg--24">
                        <div class="card-body">
                            <h4 class="text-dark-2 mb-1 h4" id="total_outstanding">-</h4>
                            <p class="mb-0 small text-dark-2">{{ trans('lang.cod_total_outstanding') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-list">
                <div class="row">
                    <div class="col-12">
                        <div class="card border">
                            <div class="card-header d-flex justify-content-between align-items-center border-0">
                                <div class="card-header-title">
                                    <h3 class="text-dark-2 mb-2 h4">{{ trans('lang.cod_drivers') }}</h3>
                                    <p class="mb-0 text-dark-2">{{ trans('lang.cod_drivers_text') }}</p>
                                </div>
                                <div class="card-header-right d-flex align-items-center">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-inline" id="cod_only_open" checked>
                                        <label class="control-label" for="cod_only_open">{{ trans('lang.cod_only_open') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive m-t-10">
                                    <table id="codDriverTable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>{{ trans('lang.driver') }}</th>
                                                <th>{{ trans('lang.driver_zone') }}</th>
                                                <th>{{ trans('lang.cod_earnings_wallet') }}</th>
                                                <th>{{ trans('lang.cod_open_orders') }}</th>
                                                <th>{{ trans('lang.cod_collected') }}</th>
                                                <th>{{ trans('lang.cod_commission') }}</th>
                                                <th>{{ trans('lang.cod_due_after_commission') }}</th>
                                                <th>{{ trans('lang.actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card border mt-3">
                            <div class="card-header d-flex justify-content-between align-items-center border-0">
                                <div class="card-header-title">
                                    <h3 class="text-dark-2 mb-2 h4">{{ trans('lang.cod_history') }}</h3>
                                    <p class="mb-0 text-dark-2">{{ trans('lang.cod_history_text') }}</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive m-t-10">
                                    <table id="codHistoryTable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>{{ trans('lang.date') }}</th>
                                                <th>{{ trans('lang.driver') }}</th>
                                                <th>{{ trans('lang.cod_orders') }}</th>
                                                <th>{{ trans('lang.cod_collected') }}</th>
                                                <th>{{ trans('lang.cod_commission') }}</th>
                                                <th>{{ trans('lang.cod_mode') }}</th>
                                                <th>{{ trans('lang.cod_wallet_deducted') }}</th>
                                                <th>{{ trans('lang.cod_cash_received') }}</th>
                                                <th>{{ trans('lang.note') }}</th>
                                                <th>{{ trans('lang.cod_settled_by') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="codSettleModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ trans('lang.cod_settle_driver') }} <span class="settle_driver_name"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-sm mb-3">
                        <tr><td>{{ trans('lang.cod_open_orders') }}</td><td class="text-right settle_orders"></td></tr>
                        <tr><td>{{ trans('lang.cod_collected') }}</td><td class="text-right settle_collected"></td></tr>
                        <tr><td>{{ trans('lang.cod_commission') }}</td><td class="text-right settle_commission"></td></tr>
                        <tr><td>{{ trans('lang.cod_due_after_commission') }}</td><td class="text-right settle_net_due"></td></tr>
                        <tr><td>{{ trans('lang.cod_earnings_wallet') }}</td><td class="text-right settle_wallet"></td></tr>
                    </table>
                    <div class="form-group">
                        <label class="control-label d-block">{{ trans('lang.cod_mode') }}</label>
                        <div class="form-check">
                            <input type="radio" class="form-check-inline" name="settle_mode" id="settle_mode_full" value="full" checked>
                            <label class="control-label" for="settle_mode_full">{{ trans('lang.cod_mode_full') }}</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-inline" name="settle_mode" id="settle_mode_net" value="net">
                            <label class="control-label" for="settle_mode_net">{{ trans('lang.cod_mode_net') }}</label>
                        </div>
                    </div>
                    <div class="alert alert-info">
                        <div>{{ trans('lang.cod_cash_received') }}: <strong class="settle_cash_received"></strong></div>
                        <div>{{ trans('lang.cod_wallet_deducted') }}: <strong class="settle_wallet_deducted"></strong></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="settle_note">{{ trans('lang.note') }}</label>
                        <textarea class="form-control" id="settle_note" rows="2"></textarea>
                    </div>
                    <div class="error_settle text-danger"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="settle_confirm">{{ trans('lang.cod_confirm') }}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('lang.close') }}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="codFixWalletModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ trans('lang.cod_fix_negative_wallet') }}: <span class="fix_driver_name"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ trans('lang.cod_fix_wallet_text') }}</p>
                    <p>{{ trans('lang.cod_earnings_wallet') }}: <strong class="fix_wallet"></strong></p>
                    <div class="form-group">
                        <label class="control-label" for="fix_note">{{ trans('lang.note') }}</label>
                        <textarea class="form-control" id="fix_note" rows="2"></textarea>
                    </div>
                    <div class="error_fix text-danger"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="fix_confirm">{{ trans('lang.cod_fix_negative_wallet') }}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('lang.close') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/cod-settlement-calc.js') }}"></script>
    <script type="text/javascript">
        var database = firebase.firestore();
        var calc = window.CodSettlementCalc;
        var adminEmail = @json(auth()->user() ? auth()->user()->email : '');
        // A Firestore transaction allows 500 writes; leave room for the settlement,
        // driver and wallet documents.
        var MAX_ENTRIES_PER_SETTLEMENT = 450;

        var currencyData = {};
        var zoneNames = {};
        var drivers = {};        // driver id -> user document data
        var openByDriver = {};   // driver id -> unsettled ledger entries (each with .docId)
        var settlements = [];
        var settleState = null;  // what the open Settle dialog shows
        var fixDriverId = null;

        function money(amount) {
            return formatCurrency(calc.toNumber(amount), currencyData);
        }

        function escapeHtml(text) {
            return $('<div>').text(text == null ? '' : String(text)).html();
        }

        function driverName(driver) {
            if (!driver) {
                return '';
            }
            return ((driver.firstName || '') + ' ' + (driver.lastName || '')).trim();
        }

        function loadAll() {
            jQuery("#data-table_processing").show();
            var reads = [];
            reads.push(database.collection('currencies').where('isActive', '==', true).get().then(function(snapshot) {
                if (!snapshot.empty) {
                    currencyData = snapshot.docs[0].data();
                }
            }));
            reads.push(database.collection('zone').get().then(function(snapshot) {
                zoneNames = {};
                snapshot.docs.forEach(function(doc) {
                    zoneNames[doc.id] = doc.data().name;
                });
            }));
            reads.push(database.collection('settings').doc('DriverNearBy').get().then(function(snap) {
                var data = snap.exists ? (snap.data() || {}) : {};
                // the apps treat a missing separateCodLedger as on
                $('.cod_ledger_off').toggle(data.separateCodLedger === false);
            }));
            // restaurants' own delivery men (vendorID set) are not platform drivers
            reads.push(database.collection('users').where('role', '==', 'driver').get().then(function(snapshot) {
                drivers = {};
                snapshot.docs.forEach(function(doc) {
                    var driver = doc.data();
                    if (!driver.vendorID) {
                        drivers[doc.id] = driver;
                    }
                });
            }));
            reads.push(database.collection('cod_ledger').where('settlementId', '==', null).get().then(function(snapshot) {
                openByDriver = {};
                snapshot.docs.forEach(function(doc) {
                    var entry = doc.data();
                    entry.docId = doc.id;
                    if (!openByDriver[entry.driverId]) {
                        openByDriver[entry.driverId] = [];
                    }
                    openByDriver[entry.driverId].push(entry);
                });
            }));
            reads.push(database.collection('cod_settlements').orderBy('settledAt', 'desc').get().then(function(snapshot) {
                settlements = snapshot.docs.map(function(doc) {
                    return doc.data();
                });
            }));
            Promise.all(reads).then(function() {
                renderTotals();
                renderDrivers();
                renderHistory();
            }).catch(function(error) {
                console.error('COD settlements load error', error);
                alert(error.message || error);
            }).finally(function() {
                jQuery("#data-table_processing").hide();
            });
        }

        function renderTotals() {
            var allOpen = [];
            Object.keys(openByDriver).forEach(function(driverId) {
                allOpen = allOpen.concat(openByDriver[driverId]);
            });
            var driverList = Object.keys(drivers).map(function(id) {
                return drivers[id];
            });
            var totals = calc.dashboardTotals(driverList, allOpen, settlements);
            $('#total_driver_earnings').text(money(totals.driverEarnings));
            $('#total_collected').text(money(totals.collectedAllTime));
            $('#total_due').text(money(totals.dueFromDrivers));
            $('#total_outstanding').text(money(totals.outstanding));
        }

        function renderDrivers() {
            var onlyOpen = $('#cod_only_open').is(':checked');
            // a ledger entry can belong to a driver who is no longer listed (deleted)
            var ids = Object.keys(drivers);
            Object.keys(openByDriver).forEach(function(id) {
                if (ids.indexOf(id) === -1) {
                    ids.push(id);
                }
            });
            var rows = [];
            ids.forEach(function(id) {
                var driver = drivers[id];
                var entries = openByDriver[id] || [];
                var totals = calc.sumEntries(entries);
                var wallet = driver ? calc.toNumber(driver.wallet_amount) : 0;
                if (onlyOpen && entries.length == 0 && wallet >= 0) {
                    return;
                }
                var name = driver ? driverName(driver) : id;
                var zone = driver && driver.zoneId ? (zoneNames[driver.zoneId] || driver.zoneId) : "{{ trans('lang.driver_no_zone') }}";
                var actions = '';
                if (entries.length > 0) {
                    actions += '<a href="javascript:void(0)" class="btn btn-primary btn-sm mr-1 mb-1 cod-settle" data-id="' + escapeHtml(id) + '">{{ trans('lang.cod_settle') }}</a>';
                }
                if (driver && wallet < 0) {
                    actions += '<a href="javascript:void(0)" class="btn btn-warning btn-sm mb-1 cod-fix-wallet" data-id="' + escapeHtml(id) + '">{{ trans('lang.cod_fix_negative_wallet') }}</a>';
                }
                var nameHtml = driver
                    ? '<a href="' + "{{ route('drivers.view', ':id') }}".replace(':id', encodeURIComponent(id)) + '">' + escapeHtml(name) + '</a>'
                    : escapeHtml(name);
                // money columns hold numbers; renderMoney formats them for display only,
                // so the table sorts by amount
                rows.push([
                    nameHtml,
                    escapeHtml(zone),
                    wallet,
                    totals.orders,
                    totals.collected,
                    totals.commission,
                    totals.netDue,
                    actions
                ]);
            });
            var table = $('#codDriverTable').DataTable();
            table.clear().rows.add(rows).draw();
        }

        function renderHistory() {
            var rows = settlements.map(function(s) {
                var date = s.settledAt && s.settledAt.toDate ? s.settledAt.toDate() : null;
                var mode = s.mode == 'net' ? "{{ trans('lang.cod_mode_net_short') }}" : "{{ trans('lang.cod_mode_full_short') }}";
                return [
                    date ? date.getTime() : 0,
                    escapeHtml(s.driverName || s.driverId),
                    (s.orderIds || []).filter(function(orderId) { return orderId; }).length,
                    calc.toNumber(s.totalCollected),
                    calc.toNumber(s.commission),
                    escapeHtml(mode),
                    calc.toNumber(s.walletDeducted),
                    calc.toNumber(s.cashReceived),
                    escapeHtml(s.note || ''),
                    escapeHtml(s.settledBy || '')
                ];
            });
            var table = $('#codHistoryTable').DataTable();
            table.clear().rows.add(rows).draw();
        }

        function renderMoney(data, type) {
            if (type !== 'display') {
                return data;
            }
            return '<span class="' + (data < 0 ? 'text-danger' : '') + '">' + money(data) + '</span>';
        }

        function renderDate(data, type) {
            if (type !== 'display') {
                return data;
            }
            if (!data) {
                return '';
            }
            var date = new Date(data);
            return escapeHtml(date.toDateString() + ' ' + date.toLocaleTimeString('en-US'));
        }

        $(document).ready(function() {
            $('#codDriverTable').DataTable({
                order: [[4, 'desc']],
                columnDefs: [
                    { targets: [2, 4, 5, 6], render: renderMoney },
                    { orderable: false, targets: [7] }
                ],
                language: datatableLang
            });
            $('#codHistoryTable').DataTable({
                order: [[0, 'desc']],
                columnDefs: [
                    { targets: [0], render: renderDate },
                    { targets: [3, 4, 6, 7], render: renderMoney }
                ],
                language: datatableLang
            });
            loadAll();
        });

        $('#cod_only_open').on('change', renderDrivers);

        // ---------- Settle ----------

        function updateSettlePreview() {
            if (!settleState) {
                return;
            }
            var mode = $('input[name="settle_mode"]:checked').val();
            var amounts = calc.settlementAmounts(settleState.totals, mode, settleState.wallet);
            $('.settle_cash_received').text(money(amounts.cashReceived));
            $('.settle_wallet_deducted').text(money(amounts.walletDeducted));
        }

        $(document).on('click', '.cod-settle', function() {
            var driverId = $(this).data('id');
            // oldest first, and no more than one transaction can write
            var entries = (openByDriver[driverId] || []).slice().sort(function(a, b) {
                var at = a.createdAt && a.createdAt.toMillis ? a.createdAt.toMillis() : 0;
                var bt = b.createdAt && b.createdAt.toMillis ? b.createdAt.toMillis() : 0;
                return at - bt;
            }).slice(0, MAX_ENTRIES_PER_SETTLEMENT);
            if (entries.length == 0) {
                alert("{{ trans('lang.cod_nothing_to_settle') }}");
                return;
            }
            var driver = drivers[driverId];
            settleState = {
                driverId: driverId,
                entries: entries,
                totals: calc.sumEntries(entries),
                wallet: driver ? calc.toNumber(driver.wallet_amount) : 0
            };
            $('.settle_driver_name').text(driver ? driverName(driver) : driverId);
            $('.settle_orders').text(settleState.totals.orders);
            $('.settle_collected').text(money(settleState.totals.collected));
            $('.settle_commission').text(money(settleState.totals.commission));
            $('.settle_net_due').text(money(settleState.totals.netDue));
            $('.settle_wallet').text(money(settleState.wallet));
            $('#settle_mode_full').prop('checked', true);
            $('#settle_note').val('');
            $('.error_settle').text('');
            $('#settle_confirm').prop('disabled', false);
            updateSettlePreview();
            $('#codSettleModal').modal('show');
        });

        $('input[name="settle_mode"]').on('change', updateSettlePreview);

        $('#settle_confirm').on('click', function() {
            if (!settleState) {
                return;
            }
            var state = settleState;
            var mode = $('input[name="settle_mode"]:checked').val() == 'net' ? 'net' : 'full';
            var note = $('#settle_note').val().trim();
            var driverRef = database.collection('users').doc(state.driverId);
            var settlementRef = database.collection('cod_settlements').doc();
            var entryRefs = state.entries.map(function(entry) {
                return database.collection('cod_ledger').doc(entry.docId);
            });
            $('#settle_confirm').prop('disabled', true);
            jQuery("#data-table_processing").show();

            // One transaction: the entries, the driver's wallet and the settlement are read
            // and written together, so an entry settled from another tab, or a wallet the
            // driver app is crediting, can never be counted twice.
            database.runTransaction(async function(transaction) {
                var driverSnap = await transaction.get(driverRef);
                var entries = [];
                for (var i = 0; i < entryRefs.length; i++) {
                    var snap = await transaction.get(entryRefs[i]);
                    if (!snap.exists || snap.data().settlementId) {
                        throw new Error("{{ trans('lang.cod_changed_reload') }}");
                    }
                    entries.push(snap.data());
                }
                var driver = driverSnap.exists ? driverSnap.data() : {};
                var wallet = calc.toNumber(driver.wallet_amount);
                var totals = calc.sumEntries(entries);
                var amounts = calc.settlementAmounts(totals, mode, wallet);

                transaction.set(settlementRef, {
                    'id': settlementRef.id,
                    'driverId': state.driverId,
                    'driverName': driverName(driver),
                    'entryIds': entryRefs.map(function(ref) { return ref.id; }),
                    'orderIds': entries.map(function(entry) { return entry.orderId || ''; }),
                    'totalCollected': totals.collected,
                    'commission': totals.commission,
                    'netDue': totals.netDue,
                    'mode': mode,
                    'walletDeducted': amounts.walletDeducted,
                    'cashReceived': amounts.cashReceived,
                    'note': note,
                    'settledAt': firebase.firestore.FieldValue.serverTimestamp(),
                    'settledBy': adminEmail
                });
                entryRefs.forEach(function(ref) {
                    transaction.update(ref, {
                        'settlementId': settlementRef.id,
                        'settledAt': firebase.firestore.FieldValue.serverTimestamp()
                    });
                });
                if (mode == 'net' && amounts.walletDeducted > 0) {
                    transaction.update(driverRef, {
                        'wallet_amount': calc.round2(wallet - amounts.walletDeducted)
                    });
                    var walletDocId = 'codset_' + settlementRef.id;
                    transaction.set(database.collection('wallet').doc(walletDocId), {
                        'id': walletDocId,
                        'amount': -amounts.walletDeducted,
                        'date': firebase.firestore.FieldValue.serverTimestamp(),
                        'isTopUp': false,
                        'order_id': '',
                        'payment_method': 'Wallet',
                        'payment_status': 'success',
                        'transactionUser': 'driver',
                        'user_id': state.driverId,
                        'note': 'COD commission kept at settlement'
                    });
                }
            }).then(function() {
                $('#codSettleModal').modal('hide');
                settleState = null;
                loadAll();
            }).catch(function(error) {
                jQuery("#data-table_processing").hide();
                $('.error_settle').text(error.message || error);
                if (error.message == "{{ trans('lang.cod_changed_reload') }}") {
                    setTimeout(function() {
                        $('#codSettleModal').modal('hide');
                        loadAll();
                    }, 2000);
                } else {
                    $('#settle_confirm').prop('disabled', false);
                }
            });
        });

        // ---------- Fix negative wallet ----------

        $(document).on('click', '.cod-fix-wallet', function() {
            fixDriverId = $(this).data('id');
            var driver = drivers[fixDriverId];
            $('.fix_driver_name').text(driverName(driver));
            $('.fix_wallet').text(money(driver.wallet_amount));
            $('#fix_note').val('');
            $('.error_fix').text('');
            $('#fix_confirm').prop('disabled', false);
            $('#codFixWalletModal').modal('show');
        });

        $('#fix_confirm').on('click', function() {
            if (!fixDriverId) {
                return;
            }
            var driverId = fixDriverId;
            var note = $('#fix_note').val().trim();
            var driverRef = database.collection('users').doc(driverId);
            var stamp = Date.now();
            var entryRef = database.collection('cod_ledger').doc('opening_' + driverId + '_' + stamp);
            var walletDocId = 'codmove_legacy_' + driverId + '_' + stamp;
            $('#fix_confirm').prop('disabled', true);
            jQuery("#data-table_processing").show();

            // The wallet is read inside the transaction, so the amount moved is exactly
            // what is negative at that moment, and the wallet ends at exactly zero.
            database.runTransaction(async function(transaction) {
                var driverSnap = await transaction.get(driverRef);
                var wallet = driverSnap.exists ? calc.toNumber(driverSnap.data().wallet_amount) : 0;
                if (wallet >= 0) {
                    throw new Error("{{ trans('lang.cod_wallet_not_negative') }}");
                }
                var amount = calc.round2(-wallet);
                transaction.set(entryRef, {
                    'id': entryRef.id,
                    'type': 'opening_balance',
                    'driverId': driverId,
                    'orderId': '',
                    'cashCollected': amount,
                    'driverCommission': 0,
                    'netDue': amount,
                    'settlementId': null,
                    'createdAt': firebase.firestore.FieldValue.serverTimestamp(),
                    'note': note ? note : 'Negative wallet moved from the old COD system'
                });
                transaction.update(driverRef, {
                    'wallet_amount': 0
                });
                transaction.set(database.collection('wallet').doc(walletDocId), {
                    'id': walletDocId,
                    'amount': amount,
                    'date': firebase.firestore.FieldValue.serverTimestamp(),
                    'isTopUp': false,
                    'order_id': '',
                    'payment_method': 'Wallet',
                    'payment_status': 'success',
                    'transactionUser': 'driver',
                    'user_id': driverId,
                    'note': 'Negative wallet moved to COD ledger'
                });
            }).then(function() {
                $('#codFixWalletModal').modal('hide');
                fixDriverId = null;
                loadAll();
            }).catch(function(error) {
                jQuery("#data-table_processing").hide();
                $('.error_fix').text(error.message || error);
            });
        });
    </script>
@endsection
