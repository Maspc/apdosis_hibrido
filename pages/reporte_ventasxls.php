<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/reporte_ventasxls.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
?>
<center><h1>Reporte de Ventas (Detalle)</h1></center><p>&nbsp;</p><p>&nbsp;</p>
<center>
	<p style="margin-left: 20"><font face="Arial" size="2" color="#000000">Introduzca la fecha que desea buscar</font></p>
	<form target="_blank" action="imprimir_reporteventa_xls.php" method="post" name="venta">
		Fecha Inicial: <input size="30" id="f_date1" name="fecha1"/><button bsmall id="f_btn1" type="button" >...</button><br />
		<p>Hora Inicial: 
			<select sformat name="hora_inicial">
				<option>01</option>
				<option>02</option>
				<option>03</option>
				<option>04</option>
				<option>05</option>
				<option>06</option>
				<option>07</option>
				<option>08</option>
				<option>09</option>
				<option>10</option>
				<option>11</option>
				<option>12</option>
				</select><select sformat  name="minuto_inicial">
				<option>00</option>
				<option>01</option>
				<option>02</option>
				<option>03</option>
				<option>04</option>
				<option>05</option>
				<option>06</option>
				<option>07</option>
				<option>08</option>
				<option>09</option>
				<option>10</option>
				<option>11</option>
				<option>12</option>
				<option>13</option>
				<option>14</option>
				<option>15</option>
				<option>16</option>
				<option>17</option>
				<option>18</option>
				<option>19</option>
				<option>20</option>
				<option>21</option>
				<option>22</option>
				<option>23</option>
				<option>24</option>
				<option>25</option>
				<option>26</option>
				<option>27</option>
				<option>28</option>
				<option>29</option>
				<option>30</option>
				<option>31</option>
				<option>32</option>
				<option>33</option>
				<option>34</option>
				<option>35</option>
				<option>36</option>
				<option>37</option>
				<option>38</option>
				<option>39</option>
				<option>40</option>
				<option>41</option>
				<option>42</option>
				<option>43</option>
				<option>44</option>
				<option>45</option>
				<option>46</option>
				<option>47</option>
				<option>48</option>
				<option>49</option>
				<option>50</option>
				<option>51</option>
				<option>52</option>
				<option>53</option>
				<option>54</option>
				<option>55</option>
				<option>56</option>
				<option>57</option>
				<option>58</option>
				<option>59</option>
			</select>
			<select sformat name="tiempo_inicial">
				<option value="1">a.m.</option>
				<option value="2">p.m.</option>
			</select>
			<p>
				Fecha Final: <input size="30" id="f_date2" name="fecha2" required /><button bsmall id="f_btn2" type="button" >...</button><br />
				<p> <p>Hora Final: 
					<select sformat name="hora_final">
						<option>01</option>
						<option>02</option>
						<option>03</option>
						<option>04</option>
						<option>05</option>
						<option>06</option>
						<option>07</option>
						<option>08</option>
						<option>09</option>
						<option>10</option>
						<option>11</option>
						<option>12</option>
						</select><select sformat name="minuto_final">
						<option>00</option>
						<option>01</option>
						<option>02</option>
						<option>03</option>
						<option>04</option>
						<option>05</option>
						<option>06</option>
						<option>07</option>
						<option>08</option>
						<option>09</option>
						<option>10</option>
						<option>11</option>
						<option>12</option>
						<option>13</option>
						<option>14</option>
						<option>15</option>
						<option>16</option>
						<option>17</option>
						<option>18</option>
						<option>19</option>
						<option>20</option>
						<option>21</option>
						<option>22</option>
						<option>23</option>
						<option>24</option>
						<option>25</option>
						<option>26</option>
						<option>27</option>
						<option>28</option>
						<option>29</option>
						<option>30</option>
						<option>31</option>
						<option>32</option>
						<option>33</option>
						<option>34</option>
						<option>35</option>
						<option>36</option>
						<option>37</option>
						<option>38</option>
						<option>39</option>
						<option>40</option>
						<option>41</option>
						<option>42</option>
						<option>43</option>
						<option>44</option>
						<option>45</option>
						<option>46</option>
						<option>47</option>
						<option>48</option>
						<option>49</option>
						<option>50</option>
						<option>51</option>
						<option>52</option>
						<option>53</option>
						<option>54</option>
						<option>55</option>
						<option>56</option>
						<option>57</option>
						<option>58</option>
						<option>59</option>
					</select>
					<select sformat name="tiempo_final">
						<option value="1">a.m.</option>
						<option value="2">p.m.</option>
					</select>
					<p> 
						<script type="text/javascript">//<![CDATA[
							var cal1 = Calendar.setup({
								inputField : "f_date1",
								trigger    : "f_btn1",
								onSelect   : function() { this.hide() },
								// dateFormat : "%Y-%m-%d %H:%M:%S"
								dateFormat : "%Y-%m-%d"
							});
							
							var cal2 = Calendar.setup({
								inputField : "f_date2",
								trigger    : "f_btn2",
								onSelect   : function() { this.hide() },
								//dateFormat : "%Y-%m-%d %H:%M:%S"
								dateFormat : "%Y-%m-%d"
							});
						//]]></script>
						
						<p>&nbsp;</p>
						<input type="submit" name="reporte" value="Llamar Reporte" class = "blue" >
					</p></form></center>
					<?=layout::fin_content()?>
						