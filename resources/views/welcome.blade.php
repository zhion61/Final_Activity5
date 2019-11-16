 <html>
<head>
    <title>Students</title>
</head>
<body>
<div id='app'>
    Select Sections:
    <select name="" id="" v-on:change='fetchStudents()' v-model='selected_section'>
        @foreach($sections as $section)
        <option value="{{ $section->id }}">{{ $section->name }}</option>
        @endforeach
    </select>
    <br/>
    Paid Students
    <ul>
        <li v-for='student in paidStudents'>@{{student.first_name}}</li>
    </ul>
    Unpaid Students
    <ul>
        <li v-for='student in unpaidStudents'>@{{student.first_name}}</li>
    </ul>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    var vm = new Vue ({
        el: '#app',
        data: {
            selected_section: '',
            students:[],
        },
        methods: {
            fetchStudents(){
                axios.get('/students?section_id='+this.selected_section).then(({data}) => {
                    this.students=data;
                    console.log(data);
                });
            }
        },
        mounted(){
            axios.get('/students').then(({data}) =>{
                console.log(data)
            });
        },
        computed:{
            paidStudents(){
                return this.students.filter(function(student) {
                        return student.date_paid !=null;
                    });
            },
            unpaidStudents(){
                return this.students.filter(function(student) {
                        return student.date_paid ==null;
                    });
            }
        }
    })
</script>
</html>