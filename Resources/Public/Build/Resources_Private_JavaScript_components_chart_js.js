"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["Resources_Private_JavaScript_components_chart_js"],{

/***/ "./Resources/Private/JavaScript/components/chart.js":
/*!**********************************************************!*\
  !*** ./Resources/Private/JavaScript/components/chart.js ***!
  \**********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var chart_js_auto__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! chart.js/auto */ "./node_modules/chart.js/auto/auto.mjs");


(function () {
  document.querySelectorAll('.graph-container').forEach(function (element) {
    var data = {
      labels: JSON.parse(element.dataset.labels),
      datasets: [{
        label: element.dataset.valueLabel,
        backgroundColor: 'rgb(238,238,238)',
        borderColor: 'rgb(238,238,238)',
        data: JSON.parse(element.dataset.values)
      }]
    };
    var config = {
      type: 'bar',
      data: data,
      options: {
        scales: {
          y: {
            display: false,
            beginAtZero: true,
            grid: {
              display: false
            }
          },
          x: {
            display: false,
            grid: {
              display: false
            }
          }
        },
        legend: {
          display: false
        },
        plugins: {
          legend: {
            display: false
          }
        }
      }
    };
    new chart_js_auto__WEBPACK_IMPORTED_MODULE_0__["default"](element, config);
  });
})();

/***/ })

}]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiUmVzb3VyY2VzX1ByaXZhdGVfSmF2YVNjcmlwdF9jb21wb25lbnRzX2NoYXJ0X2pzLmpzIiwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7O0FBQUE7O0FBRUEsQ0FBQyxZQUFNO0VBQ0hDLFFBQVEsQ0FBQ0MsZ0JBQVQsQ0FBMEIsa0JBQTFCLEVBQThDQyxPQUE5QyxDQUFzRCxVQUFDQyxPQUFELEVBQWE7SUFFL0QsSUFBSUMsSUFBSSxHQUFHO01BQ1BDLE1BQU0sRUFBRUMsSUFBSSxDQUFDQyxLQUFMLENBQVdKLE9BQU8sQ0FBQ0ssT0FBUixDQUFnQkgsTUFBM0IsQ0FERDtNQUVQSSxRQUFRLEVBQUUsQ0FBQztRQUNQQyxLQUFLLEVBQUVQLE9BQU8sQ0FBQ0ssT0FBUixDQUFnQkcsVUFEaEI7UUFFUEMsZUFBZSxFQUFFLGtCQUZWO1FBR1BDLFdBQVcsRUFBRSxrQkFITjtRQUlQVCxJQUFJLEVBQUVFLElBQUksQ0FBQ0MsS0FBTCxDQUFXSixPQUFPLENBQUNLLE9BQVIsQ0FBZ0JNLE1BQTNCO01BSkMsQ0FBRDtJQUZILENBQVg7SUFVQSxJQUFNQyxNQUFNLEdBQUc7TUFDWEMsSUFBSSxFQUFFLEtBREs7TUFFWFosSUFBSSxFQUFFQSxJQUZLO01BR1hhLE9BQU8sRUFBRTtRQUNMQyxNQUFNLEVBQUU7VUFDSkMsQ0FBQyxFQUFFO1lBQ0NDLE9BQU8sRUFBRSxLQURWO1lBRUNDLFdBQVcsRUFBRSxJQUZkO1lBR0NDLElBQUksRUFBRTtjQUNGRixPQUFPLEVBQUU7WUFEUDtVQUhQLENBREM7VUFRSkcsQ0FBQyxFQUFHO1lBQ0FILE9BQU8sRUFBRSxLQURUO1lBRUFFLElBQUksRUFBRTtjQUNGRixPQUFPLEVBQUU7WUFEUDtVQUZOO1FBUkEsQ0FESDtRQWdCTEksTUFBTSxFQUFFO1VBQ0pKLE9BQU8sRUFBRTtRQURMLENBaEJIO1FBbUJMSyxPQUFPLEVBQUU7VUFDTEQsTUFBTSxFQUFFO1lBQ0pKLE9BQU8sRUFBRTtVQURMO1FBREg7TUFuQko7SUFIRSxDQUFmO0lBNkJBLElBQUlyQixxREFBSixDQUNJSSxPQURKLEVBRUlZLE1BRko7RUFJSCxDQTdDRDtBQThDSCxDQS9DRCIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL1Jlc291cmNlcy9Qcml2YXRlL0phdmFTY3JpcHQvY29tcG9uZW50cy9jaGFydC5qcyJdLCJzb3VyY2VzQ29udGVudCI6WyJpbXBvcnQgQ2hhcnQgZnJvbSAnY2hhcnQuanMvYXV0byc7XG5cbigoKSA9PiB7XG4gICAgZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnLmdyYXBoLWNvbnRhaW5lcicpLmZvckVhY2goKGVsZW1lbnQpID0+IHtcblxuICAgICAgICBsZXQgZGF0YSA9IHtcbiAgICAgICAgICAgIGxhYmVsczogSlNPTi5wYXJzZShlbGVtZW50LmRhdGFzZXQubGFiZWxzKSxcbiAgICAgICAgICAgIGRhdGFzZXRzOiBbe1xuICAgICAgICAgICAgICAgIGxhYmVsOiBlbGVtZW50LmRhdGFzZXQudmFsdWVMYWJlbCxcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kQ29sb3I6ICdyZ2IoMjM4LDIzOCwyMzgpJyxcbiAgICAgICAgICAgICAgICBib3JkZXJDb2xvcjogJ3JnYigyMzgsMjM4LDIzOCknLFxuICAgICAgICAgICAgICAgIGRhdGE6IEpTT04ucGFyc2UoZWxlbWVudC5kYXRhc2V0LnZhbHVlcyksXG4gICAgICAgICAgICB9XVxuICAgICAgICB9O1xuXG4gICAgICAgIGNvbnN0IGNvbmZpZyA9IHtcbiAgICAgICAgICAgIHR5cGU6ICdiYXInLFxuICAgICAgICAgICAgZGF0YTogZGF0YSxcbiAgICAgICAgICAgIG9wdGlvbnM6IHtcbiAgICAgICAgICAgICAgICBzY2FsZXM6IHtcbiAgICAgICAgICAgICAgICAgICAgeToge1xuICAgICAgICAgICAgICAgICAgICAgICAgZGlzcGxheTogZmFsc2UsXG4gICAgICAgICAgICAgICAgICAgICAgICBiZWdpbkF0WmVybzogdHJ1ZSxcbiAgICAgICAgICAgICAgICAgICAgICAgIGdyaWQ6IHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBkaXNwbGF5OiBmYWxzZVxuICAgICAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgICAgICAgICB4IDoge1xuICAgICAgICAgICAgICAgICAgICAgICAgZGlzcGxheTogZmFsc2UsXG4gICAgICAgICAgICAgICAgICAgICAgICBncmlkOiB7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgZGlzcGxheTogZmFsc2VcbiAgICAgICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAgbGVnZW5kOiB7XG4gICAgICAgICAgICAgICAgICAgIGRpc3BsYXk6IGZhbHNlXG4gICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICBwbHVnaW5zOiB7XG4gICAgICAgICAgICAgICAgICAgIGxlZ2VuZDoge1xuICAgICAgICAgICAgICAgICAgICAgICAgZGlzcGxheTogZmFsc2VcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0sXG4gICAgICAgIH07XG4gICAgICAgIG5ldyBDaGFydChcbiAgICAgICAgICAgIGVsZW1lbnQsXG4gICAgICAgICAgICBjb25maWdcbiAgICAgICAgKTtcbiAgICB9KVxufSkoKTsiXSwibmFtZXMiOlsiQ2hhcnQiLCJkb2N1bWVudCIsInF1ZXJ5U2VsZWN0b3JBbGwiLCJmb3JFYWNoIiwiZWxlbWVudCIsImRhdGEiLCJsYWJlbHMiLCJKU09OIiwicGFyc2UiLCJkYXRhc2V0IiwiZGF0YXNldHMiLCJsYWJlbCIsInZhbHVlTGFiZWwiLCJiYWNrZ3JvdW5kQ29sb3IiLCJib3JkZXJDb2xvciIsInZhbHVlcyIsImNvbmZpZyIsInR5cGUiLCJvcHRpb25zIiwic2NhbGVzIiwieSIsImRpc3BsYXkiLCJiZWdpbkF0WmVybyIsImdyaWQiLCJ4IiwibGVnZW5kIiwicGx1Z2lucyJdLCJzb3VyY2VSb290IjoiIn0=