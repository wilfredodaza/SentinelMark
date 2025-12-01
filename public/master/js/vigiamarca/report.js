$(() => {

  const dateInput = $('.date-input');
  if (dateInput.length) {
      dateInput.flatpickr({
          locale:             "es",
          monthSelectorType:  'dropdown',
      });
  }

    const labels_name = [], labels_number = [];

    months.forEach(m => {
        labels_name.push(`${m.short} - ${m.year}`);
        labels_number.push(m.hallazgos);
    });

    console.log([labels_name, labels_number])

    let labelColor, headingColor, borderColor, currentTheme, bodyColor, legendColor, cardColor;
    legendColor = config.colors_dark.bodyColor;
    cardColor = config.colors_dark.cardColor;
    

    // Chart Colors
    const chartColors = {
        donut: {
            series1: '#fbe9e7',
            series2: '#ffab91',
            series3: '#ff7043',
            series4: '#f4511e',
            series5: '#d84315'
        },
        line: {
            series2: config.colors.primary,
            series1: config.colors.warning,
            series3: '#7367f029'
        }
    };
  
    if (isDarkStyle) {
        labelColor = config.colors_dark.textMuted;
        headingColor = config.colors_dark.headingColor;
        borderColor = config.colors_dark.borderColor;
        bodyColor = config.colors.bodyColor;
        currentTheme = 'dark';
    } else {
        labelColor = config.colors.textMuted;
        headingColor = config.colors.headingColor;
        borderColor = config.colors.borderColor;
        bodyColor = config.colors_dark.bodyColor;
        currentTheme = 'light';
    }

    const horizontalBarChartEl = document.querySelector('#horizontalBarChart'),
    horizontalBarChartConfig = {
        chart: {
            height: 270,
            type: 'bar',
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                barHeight: '70%',
                distributed: true,
                startingShape: 'rounded',
                borderRadius: 7
            }
        },
        grid: {
            strokeDashArray: 10,
            borderColor: borderColor,
            xaxis: {
                lines: {
                    show: false
                }
            },
            yaxis: {
                lines: {
                    show: true
                }
            },
            // padding: {
            //     top: -35,
            //     bottom: -12
            // }
        },
        fill: {
            opacity: 1
        },
        colors: [
            config.colors.primary,
        ],
        dataLabels: {
            enabled: false,
            style: {
                colors: ['#fff'],
                fontWeight: 500,
                fontSize: '13px',
                fontFamily: 'Inter'
            },
            formatter: function (val, opts) {
                return horizontalBarChartConfig.labels[opts.dataPointIndex];
            },
            offsetX: 0,
            dropShadow: {
                enabled: false
            }
        },
        labels: labels_name,
        series: [
            {
                data: labels_number
            }
        ],

        xaxis: {
            // categories: ['6', '5', '4', '3', '2', '1'],
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            labels: {
                style: {
                    colors: labelColor,
                    fontSize: '13px'
                },
                formatter: function (val) {
                    return `${val}`;
                }
            }
        },
        yaxis: {
            // max: 35,
            labels: {
                style: {
                    colors: [labelColor],
                    fontFamily: 'Inter',
                    fontSize: '13px'
                }
            }
        },
        tooltip: {
            enabled: true,
            style: {
                fontSize: '12px'
            },
            onDatasetHover: {
                highlightDataSeries: false
            },
            custom: function ({ series, seriesIndex, dataPointIndex, w }) {
                return `<div class="px-3 py-2"><span>${months[dataPointIndex].nombre}: ${series[seriesIndex][dataPointIndex]}</span></div>`;
            }
        },
        legend: {
            show: false
        }
    };
    if (typeof horizontalBarChartEl !== undefined && horizontalBarChartEl !== null) {
        const horizontalBarChart = new ApexCharts(horizontalBarChartEl, horizontalBarChartConfig);
        horizontalBarChart.render();
    }


    let total = 0;
    const labels_name_brands = brands.reduce((acc, b) => {
        acc.push(b.nombre_corto);
        total += b.hallazgos;
        return acc;
    }, []);

    const labels_total_brands = brands.reduce((acc, b) => {
        acc.push(Math.round((parseInt(b.hallazgos) * 100) / total))
        return acc;
    }, [])

    console.log([labels_name_brands, total, labels_total_brands])

    // Reasons for delivery exceptions Chart
  // --------------------------------------------------------------------
  const deliveryExceptionsChartE1 = document.querySelector('#deliveryExceptionsChart'),
  deliveryExceptionsChartConfig = {
    chart: {
      height: 420,
      parentHeightOffset: 0,
      type: 'donut'
    },
    labels: labels_name_brands,
    series: labels_total_brands,
    colors: [
      chartColors.donut.series1,
      chartColors.donut.series2,
      chartColors.donut.series3,
      chartColors.donut.series4,
      chartColors.donut.series5
    ],
    stroke: {
      width: 0
    },
    dataLabels: {
      enabled: false,
      formatter: function (val, opt) {
        return Math.round(val) + '%';
      }
    },
    legend: {
      show: true,
      position: 'bottom',
      offsetY: 10,
      markers: {
        width: 8,
        height: 8,
        offsetX: -5
      },
      itemMargin: {
        horizontal: 16,
        vertical: 5
      },
      fontSize: '13px',
      fontFamily: 'Inter',
      fontWeight: 400,
      labels: {
        colors: headingColor,
        useSeriesColors: false
      }
    },
    tooltip: {
      theme: currentTheme,
      y: {
        formatter: function (value) {
          return value + '%';
        }
      }
    },
    grid: {
      padding: {
        top: 15
      }
    },
    plotOptions: {
      pie: {
        donut: {
          size: '75%',
          labels: {
            show: true,
            value: {
              fontSize: '24px',
              fontFamily: 'Inter',
              color: headingColor,
              fontWeight: 500,
              offsetY: -30,
              formatter: function (val) {
                return Math.round(val) + '%';
              }
            },
            name: {
              offsetY: 20,
              fontFamily: 'Inter'
            },
            total: {
              show: true,
              fontSize: '15px',
              fontFamily: 'Inter',
              label: labels_name_brands[0],
              color: bodyColor,
              formatter: function (w) {
                return `${Math.round(labels_total_brands[0])}%`;
              }
            }
          }
        }
      }
    },
    responsive: [
      {
        breakpoint: 420,
        options: {
          chart: {
            height: 360
          }
        }
      }
    ]
  };
if (typeof deliveryExceptionsChartE1 !== undefined && deliveryExceptionsChartE1 !== null) {
  const deliveryExceptionsChart = new ApexCharts(deliveryExceptionsChartE1, deliveryExceptionsChartConfig);
  deliveryExceptionsChart.render();
}


// Heat map chart

// function generateDataHeat(count, yrange) {
//   let i = 0;
//   let series = [];
//   while (i < count) {
//     let x = 'w' + (i + 1).toString();
//     let y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

//     series.push({
//       x: x,
//       y: y
//     });
//     i++;
//   }
//   return series;
// }
  // --------------------------------------------------------------------
  const heatMapEl = document.querySelector('#heatMapChart'),
    heatMapChartConfig = {
      chart: {
        height: "100%",
        fontFamily: 'Inter',
        type: 'heatmap',
        parentHeightOffset: 0,
        toolbar: {
          show: false
        }
      },
      plotOptions: {
        heatmap: {
          enableShades: false,
          padding: 0,
          colorScale: {
            ranges: [
              {
                from: 0,
                to: 5,
                name: '0-10',
                color: '#ffebee'
              },
              {
                from: 6,
                to: 11,
                name: '10-20',
                color: '#ef9a9a'
              },
              {
                from: 12,
                to: 17,
                name: '20-30',
                color: '#ef5350'
              },
              {
                from: 18,
                to: 23,
                name: '30-40',
                color: '#e53935'
              },
              {
                from: 24,
                to: 30,
                name: '40-50',
                color: '#c62828'
              },
              {
                from: 31,
                to: 36,
                name: '50-60',
                color: '#d50000'
              }
            ]
          }
        }
      },
      dataLabels: {
        enabled: false
      },
      grid: {
        show: true
      },
      legend: {
        show: false,
        position: 'bottom',
        fontSize: '13px',
        labels: {
          colors: legendColor,
          useSeriesColors: false
        },
        markers: {
          offsetY: 0,
          offsetX: 0,
          height: 25,
          width: 10
        },
        itemMargin: {
          vertical: 10,
          horizontal: 10
        }
      },
      // stroke: {
      //   curve: 'smooth',
      //   width: 1,
      //   height:1,
      //   lineCap: 'round',
      //   colors: [cardColor]
      // },
      series: mapheat,
      xaxis: {
        labels: {
          show: true,
          style: {
            colors: labelColor,
            fontSize: '10px'
          }
        },
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        }
      },
      yaxis: {
        labels: {
          style: {
            colors: labelColor,
            fontSize: '13px'
          }
        }
      }
    };
  if (typeof heatMapEl !== undefined && heatMapEl !== null) {
    const heatMapChart = new ApexCharts(heatMapEl, heatMapChartConfig);
    heatMapChart.render();
  }


function radialBarChart(color, value, show) {
    const radialBarChartOpt = {
      chart: {
        height: show == 'true' ? 58 : 55,
        width: show == 'true' ? 58 : 45,
        type: 'radialBar'
      },
      plotOptions: {
        radialBar: {
          hollow: {
            size: show == 'true' ? '45%' : '25%'
          },
          dataLabels: {
            show: show == 'true' ? true : false,
            value: {
              offsetY: -10,
              fontSize: '15px',
              fontWeight: 500,
              fontFamily: 'Inter',
              color: headingColor
            }
          },
          track: {
            background: config.colors_label.secondary
          }
        }
      },
      stroke: {
        lineCap: 'round'
      },
      colors: [color],
      grid: {
        padding: {
          top: show == 'true' ? -12 : -15,
          bottom: show == 'true' ? -17 : -15,
          left: show == 'true' ? -17 : -5,
          right: -15
        }
      },
      series: [value],
      labels: show == 'true' ? [''] : ['Progress']
    };
    return radialBarChartOpt;
  }

  const chartProgressList = document.querySelectorAll('.chart-progress');
  if (chartProgressList) {
    chartProgressList.forEach(function (chartProgressEl) {
      const color = config.colors[chartProgressEl.dataset.color],
        series = chartProgressEl.dataset.series;
      const progress_variant = chartProgressEl.dataset.progress_variant;
      const optionsBundle = radialBarChart(color, series, progress_variant);
      const chart = new ApexCharts(chartProgressEl, optionsBundle);
      chart.render();
    });
  }


    console.log(seriesTreemap)

    var options = {
      series: seriesTreemap,
      colors: ['#FF2900', '#FF6145', '#FF7861', '#FF8E7A', '#FFA494'],

      chart: {
          type: 'treemap',
          height: 500
      },
      
      legend: {
          show: true
      },
      
      tooltip: {
          y: {
              formatter: val => val + " hallazgos"
          }
      },
      
      // plotOptions: {
      //     treemap: {
      //         colorScale: {
      //             ranges: [
      //                 { from: 0, to: 150, color: '#CD363A' },
      //                 { from: 151, to: 200, color: '#52B12C' },
      //                 { from: 201, to: 250, color: '#9e9d24' },
      //                 { from: 251, to: 300, color: '#81c784' },
      //                 { from: 301, to: 1000, color: '#00c853' },
      //             ]
      //         }
      //     }
      // },
      
      // dataLabels: {
      //     enabled: true,
      //     style: {
      //         fontSize: '14px',
      //         fontWeight: 'bold',
      //         colors: ['#000']
      //     },
      //     formatter: function (text, opt) {
      //         // Muestra el ID de la clase dentro del cuadrado
      //         return opt.w.config.series[0].data[opt.dataPointIndex].x;
      //     }
      // }
      
    };

    var chart = new ApexCharts(document.querySelector("#treemap"), options);
    chart.render();
})