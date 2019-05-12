<div class="footer">
			@php
			$dateTime = App\FreeFunction::getTime();
			@endphp
			<p style="background: ghostwhite !important">MiniMark - Code by Bay Nguyen 2018<br>
				University of Science and Technology - University of Danang<br>
				Server time: {{$dateTime}} (UTC+7)<br>
			</p>
		</div>


	</div>

</body>
</html>