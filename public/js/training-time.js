new Vue({
    el: '#training-time',
    data: {
        trainings: [],
        days: [
            'Воскресенье',
            'Понедельник',
            'Вторник',
            'Среда',
            'Четверг',
            'Пятница',
            'Субота'
        ],
        isActive: false,
        data: '',
        day: '',
        sunday: [
            {name: 'Нет запланированых занятий'},
        ],
        monday: [
            { time: '9.30', name: 'Тренажорный зал', trener: 'С Олей' },
            { time: '10.30', name: 'BTS', trener: 'С тренером' },
            { time: '17.15', name: 'Тренажорный зал', trener: 'С Олей' },
            { time: '18.30', name: 'Функционал', trener: 'С тренером' },
            { time: '19.30', name: 'Занятие пилатесом', trener: 'С Натай' }
        ],
        tuesday: [
            { time: '9.30', name: 'Тренажорный зал', trener: 'С Леной' },
            { time: '13.30', name: 'Занятие пилатесом', trener: 'С тренером' },
            { time: '17.00', name: 'Тренажорный зал', trener: 'С Олей' },
            { time: '18.20', name: 'Калланетика', trener: 'С тренером' },
            { time: '19.30', name: 'Занятие пилатесом', trener: 'С Натай' }
        ],
        wednesday: [
            { time: '9.30', name: 'Тренажорный зал', trener: 'С Олей' },
            { time: '10.30', name: 'BTS', trener: 'С тренером' },
            { time: '17.15', name: 'Йога', trener: 'С тренером' },
            { time: '18.30', name: 'Workout', trener: 'С тренером' },
            { time: '19.30', name: 'Занятие пилатесом', trener: 'С Натай' }
        ],
        thursday: [
            { time: '7.30', name: 'Йога', trener: 'С тренером' },
            { time: '9.30', name: 'Тренажорный зал', trener: 'С Леной' },
            { time: '13.30', name: 'Занятие пилатесом', trener: 'С тренером' },
            { time: '17.00', name: 'Тренажорный зал', trener: 'С Олей' },
            { time: '18.20', name: 'Калланетика', trener: 'С тренером' },
            { time: '19.30', name: 'Занятие', trener: 'С Ириной' }
        ],
        friday: [
            { time: '9.30', name: 'Тренажорный зал', trener: 'С Олей' },
            { time: '10.30', name: 'BTS', trener: 'С тренером' },
            { time: '17.15', name: 'Силовая', trener: 'С тренером' },
            { time: '18.30', name: 'Stretch', trener: 'С Таней' },
            { time: '19.30', name: 'Сайкл', trener: 'С Натай' }
        ],
        saturday: [
            { time: '9.30', name: 'ТАБАТА', trener: 'С тренером' },
            { time: '11.00', name: 'Йога', trener: 'С тренером' }
        ]

    },
    methods: {
        getTraining(key) {
            switch (key) {
                case 0: 
                    this.trainings = this.sunday;
                    this.isActive = true;
                    break;
                case 1:
                     this.trainings = this.monday;
                     this.isActive = false;
                     break;
                case 2:
                     this.trainings = this.tuesday;
                     this.isActive = false;
                     break;
                case 3:
                     this.trainings = this.wednesday;
                     this.isActive = false;
                     break;
                case 4:
                     this.trainings = this.thursday;
                     this.isActive = false;
                     break;
                case 5:
                     this.trainings = this.friday;
                     this.isActive = false;
                     break;
                case 6:
                     this.trainings = this.saturday;
                     this.isActive = false;
                     break;
            }
        }
    },
    mounted: function () {
        let dat = new Date();
        let dd = dat.getDate();
        if (dd < 10) dd = '0' + dd;
        let mm = dat.getMonth() + 1;
        if (mm < 10) mm = '0' + mm;
        this.data = dd + '.' + mm;

        let d = dat.getDay();
        this.day = this.days[d];

        switch (this.day) {
            case "Воскресенье": this.trainings = this.sunday; break;
            case "Понедельник": this.trainings = this.monday; break;
            case "Вторник": this.trainings = this.tuesday; break;
            case "Среда": this.trainings = this.wednesday; break;
            case "Четверг": this.trainings = this.thursday; break;
            case "Пятница": this.trainings = this.friday; break;
            case "Субота": this.trainings = this.saturday; break;
        }
    },
})