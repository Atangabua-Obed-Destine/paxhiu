<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>ID Cards</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/prints/student_id_card.css') }}" media="screen, print">

    <style>
        @page { size: auto; margin: 10px; }
        .page-break { page-break-after: always; }
        @import url('https://fonts.googleapis.com/css2?family=Anton&display=swap');
        /* @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&display=swap'); */

.id-card {
    width: 711px;
    height: 450px;
    position: relative;
    background: url('{{ asset('uploads/templates/Id.png') }}') no-repeat center center;
    background-size: cover;
    font-family: 'Anton'; 
    font-style: normal;
    color: #000;
}
.id-card div{
    margin-top: 25px;
}

/* Student Photo */
.id-card .photo {
    position: absolute;
    top: 137px;
    right: 35px;
    width: 182px;
    height: 199px;
    border: 2px solid #000;
}
.id-card .photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Text Fields */
.id-card .name {
    position: absolute;
    top: 165px;
    left: 150px;
    font-size: 22px;
    /* font-family: "Anton"; */
    font-weight: 700;
    letter-spacing: 0.5px;
    /* font-style: normal; */
    color: #001F5B; /* dark blue tone to match template */
}

.id-card .dob,
.id-card .sex,
.id-card .matricule,
.id-card .faculty,
.id-card .date-issued {
    position: absolute;
    left: 220px;
    font-size: 20px;
    font-weight: 700;
    letter-spacing: 0.3px;
    color: #000;
    font-family: "Anton";
}

.id-card .dob { top: 188px; left: 150px; }
.id-card .sex { top: 207px; left: left: 150px; }
.id-card .matricule { top: 228px; left: 150px; font-weight: 700; }
.id-card .faculty { top: 251px; left: 150px; }
.id-card .date-issued { top: 272px; left: 150px; }

    </style>
</head>
<body>

@foreach($rows as $row)
    <div class="id-card">
        <!-- Student Photo -->
        <div class="photo">
            @if(is_file('uploads/student/'.$row->photo))
                <img src="{{ asset('uploads/student/'.$row->photo) }}" alt="Photo">
            @else
                <img src="{{ asset('dashboard/images/user.jpg') }}" alt="Photo">
            @endif
        </div>

        <!-- Student Name -->
        <div class="name">{{ $row->first_name }} {{ $row->last_name }}</div>

        <!-- Date of Birth -->
        <div class="dob">{{ date('d/m/Y', strtotime($row->dob)) }}</div>

        <!-- Sex -->
        <div class="sex">{{ $row->gender }}</div>

        <!-- Matricule -->
        <div class="matricule">{{ $print->prefix ?? '' }}{{ $row->student_id }}</div>

        <!-- Faculty -->
        <div  class="faculty">{{ $row->program->shortcode ?? $row->program->title }}</div>

        <!-- Date Issued -->
        <div class="date-issued">{{ date('d/m/Y') }}</div>
    </div>

    <div class="page-break"></div>
@endforeach

</body>
</html>
