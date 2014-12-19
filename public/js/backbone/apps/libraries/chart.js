/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

define(['jquery', 'highcharts'], function($) {

    var chart = {
        options: {
            type: 'line',
            title: '',
            subtitle: '',
            yAxisTitle: '',
            xLabelRotation: -45,
            xLabelX: 25
        },
        initiliaze: function(options) {
            this.options = options;
        },
        render: function(container, categories, series) {
            $(container).highcharts({
                chart: {
                    type: this.options.type
                },
                title: {
                    text: this.options.title
                },
                subtitle: {
                    text: this.options.subtitle
                },
                xAxis: {
                    categories: categories,
                    labels: {
                        rotation: this.options.xLabelRotation,
                        x: this.options.xLabelX
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: this.options.yAxisTitle
                    }
                },
                series: series
            });
        }
    };
    return chart;
});


