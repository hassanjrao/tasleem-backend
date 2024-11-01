/******/ (() => { // webpackBootstrap
/*!*************************************************!*\
  !*** ./resources/js/pages/tables_datatables.js ***!
  \*************************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
/*
 *  Document   : tables_datatables.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Plugin Init Example Page
 */
// DataTables, for more examples you can check out https://www.datatables.net/
var pageTablesDatatables = /*#__PURE__*/function () {
  function pageTablesDatatables() {
    _classCallCheck(this, pageTablesDatatables);
  }
  return _createClass(pageTablesDatatables, null, [{
    key: "initDataTables",
    value:
    /*
     * Init DataTables functionality
     *
     */
    function initDataTables() {
      // Override a few default classes
      jQuery.extend(jQuery.fn.dataTable.ext.classes, {
        sWrapper: "dataTables_wrapper dt-bootstrap5",
        sFilterInput: "form-control form-control-sm",
        sLengthSelect: "form-select form-select-sm"
      });

      // Override a few defaults
      jQuery.extend(true, jQuery.fn.dataTable.defaults, {
        language: {
          lengthMenu: "_MENU_",
          search: "_INPUT_",
          searchPlaceholder: "Search..",
          info: "Page <strong>_PAGE_</strong> of <strong>_PAGES_</strong>",
          paginate: {
            first: '<i class="fa fa-angle-double-left"></i>',
            previous: '<i class="fa fa-angle-left"></i>',
            next: '<i class="fa fa-angle-right"></i>',
            last: '<i class="fa fa-angle-double-right"></i>'
          }
        }
      });

      // Init full DataTable
      jQuery('.js-dataTable-full').dataTable({
        pageLength: 5,
        lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
        autoWidth: false
      });

      // Init DataTable with Buttons
      jQuery('.js-dataTable-buttons').dataTable({
        pageLength: 5,
        lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
        autoWidth: false,
        buttons: [{
          extend: 'copy',
          className: 'btn btn-sm btn-primary'
        }, {
          extend: 'csv',
          className: 'btn btn-sm btn-primary'
        }, {
          extend: 'print',
          className: 'btn btn-sm btn-primary'
        }],
        dom: "<'row'<'col-sm-12'<'text-center bg-body-light py-2 mb-2'B>>>" + "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
      });
    }

    /*
     * Init functionality
     *
     */
  }, {
    key: "init",
    value: function init() {
      this.initDataTables();
    }
  }]);
}(); // Initialize when page loads
jQuery(function () {
  pageTablesDatatables.init();
});
/******/ })()
;