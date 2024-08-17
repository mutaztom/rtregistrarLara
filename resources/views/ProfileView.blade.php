
    <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-3 divide-y
     divide-purple-400 border-solid gap-3 h-48 overflow-auto">
        <p> Name: <span class="font-bold text-blue-500">{{ $registrant->regname }}</span></p>
        <p>Email: <span class="font-bold text-blue-500">{{ $registrant->email }}</span></p>
        <p>Phone: <span class="font-bold text-blue-500">{{ $registrant->phone ?: 'None' }}</span></p>
        <p>High Education Id: <span class="font-bold text-blue-500">{{ $registrant->higheducid ?: 'None' }}</span></p>
        <p> Engineering council Number:<span class="font-bold text-blue-500">{{ $registrant->engcouncilNumber ?: 'None' }}</span></p>
        <p>Nationality: <span class="font-bold text-blue-500">{{ $registrant->nationality }}</span></p>
        <p>Birth Date: <span class="font-bold text-blue-500">{{ $registrant->birthdate ?: 'None' }}</span></p>
        <p>Birth Place: <span class="font-bold text-blue-500">{{ $registrant->birthPlace ?: 'None' }}</span></p>
        <p>ID Type: <span class="font-bold text-blue-500">{{ $registrant->engcouncilNumber ?: 'None' }}</span></p>
        <p>Country: <span class="font-bold text-blue-500">{{ $registrant->nationality }}</span></p>
        <p>City: <span class="font-bold text-blue-500">{{ $registrant->city }}</span></p>
        <p>ID Number: <span class="font-bold text-blue-500">{{ $registrant->idnumber }}</span></p>
        <p>Gender: <span class="font-bold text-blue-500">{{ $registrant->gender }}</span></p>
    </div>

