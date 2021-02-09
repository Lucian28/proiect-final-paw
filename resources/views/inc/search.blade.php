<head>
    <style>



.input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
}

.submit {

  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.search-container button:hover {
  background: #ccc;
} 
    </style>
</head>

<form action="{{ route('search') }}" method="GET">
    <input  type="text" name="search" required/>
    <button type="submit" style="background-color: rgb(43, 67, 119); color:white"> Cauta o postare </button>
</form>