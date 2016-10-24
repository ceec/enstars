@extends('layouts.layout')

@section('title')
@parent
Birthday Calendar | enstars.info
@stop

@section('content')
<style>
.birthday {
    background-color: #6699FF;
}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">

        	<h1>Birthday Calendar</h1>
            <div class="row">
                <div class="col-md-3">
                    <h3>January</h3>
                    <table class="table">
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                            <td>7</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>9</td>
                            <td><span class="birthday">10</span></td>
                            <td>11</td>
                            <td>12</td>
                            <td><span class="birthday">13</span></td>
                            <td>14</td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>16</td>
                            <td>17</td>
                            <td>18</td>
                            <td>19</td>
                            <td>20</td>
                            <td>21</td>
                        </tr>
                        <tr>
                            <td>22</td>
                            <td>23</td>
                            <td>24</td>
                            <td>25</td>
                            <td><span class="birthday">26</span></td>
                            <td>27</td>
                            <td>28</td>
                        </tr>
                        <tr>
                            <td>29</td>
                            <td>30</td>
                            <td>31</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>                                                                                                 
                    </table>
                    <ul>
                        <li>10 - Tenshouin Eichi</li>
                        <li>13 - Himemiya Tori</li>
                        <li>26 - Kiryuu Kuro</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h3>February</h3>
                    <table class="table">
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td><span class="birthday">4</span></td>
                            <td>5</td>
                            <td>6</td>
                            <td>7</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>9</td>
                            <td>10</td>
                            <td>11</td>
                            <td>12</td>
                            <td>13</td>
                            <td>14</td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>16</td>
                            <td>17</td>
                            <td>18</td>
                            <td>19</td>
                            <td>20</td>
                            <td><span class="birthday">21</span></td>
                        </tr>
                        <tr>
                            <td>22</td>
                            <td>23</td>
                            <td>24</td>
                            <td><span class="birthday">25</span></td>
                            <td>26</td>
                            <td>27</td>
                            <td>28</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>                                                                                                 
                    </table>
                    <ul>
                        <li>4 - Sakasaki Natsume</li>
                        <li>21 - Hibiki Wataru</li>
                        <li>25 - Kunegi Asaomi</li>
                    </ul>                                    
                </div>
                <div class="col-md-3">
                    <h3>March</h3>
                    <table class="table">
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td><span class="birthday">3</span></td>
                            <td>4</td>
                            <td><span class="birthday">5</span></td>
                            <td>6</td>
                            <td>7</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>9</td>
                            <td>10</td>
                            <td>11</td>
                            <td>12</td>
                            <td>13</td>
                            <td>14</td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td><span class="birthday">16</span></td>
                            <td>17</td>
                            <td>18</td>
                            <td>19</td>
                            <td>20</td>
                            <td>21</td>
                        </tr>
                        <tr>
                            <td>22</td>
                            <td>23</td>
                            <td>24</td>
                            <td>25</td>
                            <td>26</td>
                            <td>27</td>
                            <td>28</td>
                        </tr>
                        <tr>
                            <td><span class="birthday">29</span></td>
                            <td>30</td>
                            <td>31</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>                                                                                                 
                    </table>
                    <ul>
                        <li>3 - Narukami Arashi</li>
                        <li>5 - Aoi Yuuta</li>
                        <li>5 - Aoi Hinata</li>
                        <li>16  - Isara Mao</li>
                        <li>29 - Mashiro Tomoya</li>
                    </ul>                                    
                </div> 
                <div class="col-md-3">
                    <h3>April</h3>
                    <table class="table">
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td><span class="birthday">6</span></td>
                            <td>7</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>9</td>
                            <td>10</td>
                            <td>11</td>
                            <td>12</td>
                            <td>13</td>
                            <td>14</td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>16</td>
                            <td>17</td>
                            <td>18</td>
                            <td>19</td>
                            <td><span class="birthday">20</span></td>
                            <td>21</td>
                        </tr>
                        <tr>
                            <td>22</td>
                            <td>23</td>
                            <td>24</td>
                            <td>25</td>
                            <td>26</td>
                            <td><span class="birthday">27</span></td>
                            <td>28</td>
                        </tr>
                        <tr>
                            <td>29</td>
                            <td><span class="birthday">30</span></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>                                                                                                 
                    </table>
                    <ul>
                        <li>6  - Suou Tsukasa</li>
                        <li>20 - Kanzaki Souma</li>
                        <li>27 - Nito Nazuna</li>
                        <li>30 - Yuuki Makoto</li>
                    </ul>                    
                </div>                                               
            </div> <!-- end calendar row of 4 -->
            <div class="row">
                <div class="col-md-3">
                    <h3>May</h3>
                    <table class="table">
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td><span class="birthday">5</span></td>
                            <td>6</td>
                            <td>7</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>9</td>
                            <td>10</td>
                            <td>11</td>
                            <td>12</td>
                            <td>13</td>
                            <td>14</td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>16</td>
                            <td>17</td>
                            <td>18</td>
                            <td>19</td>
                            <td>20</td>
                            <td>21</td>
                        </tr>
                        <tr>
                            <td>22</td>
                            <td>23</td>
                            <td>24</td>
                            <td>25</td>
                            <td>26</td>
                            <td>27</td>
                            <td>28</td>
                        </tr>
                        <tr>
                            <td>29</td>
                            <td>30</td>
                            <td>31</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>                                                                                                 
                    </table>
                    <ul>
                        <li>5 - Tsukinaga Leo</li>
                    </ul>                                    
                </div>
                <div class="col-md-3">
                    <h3>June</h3>
                    <table class="table">
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                            <td>7</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td><span class="birthday">9</span></td>
                            <td>10</td>
                            <td>11</td>
                            <td>12</td>
                            <td>13</td>
                            <td>14</td>
                        </tr>
                        <tr>
                            <td><span class="birthday">15</span></td>
                            <td>16</td>
                            <td>17</td>
                            <td>18</td>
                            <td>19</td>
                            <td>20</td>
                            <td>21</td>
                        </tr>
                        <tr>
                            <td><span class="birthday">22</span></td>
                            <td>23</td>
                            <td>24</td>
                            <td>25</td>
                            <td>26</td>
                            <td>27</td>
                            <td>28</td>
                        </tr>
                        <tr>
                            <td>29</td>
                            <td>30</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>                                                                                                 
                    </table>
                    <ul>
                        <li>9 - Sengoku Shinobu</li>
                        <li>15 - Nagumo Tetora</li>
                        <li>22 - Akehoshi Subaru</li>
                    </ul>                                    
                </div>     
                <div class="col-md-3">
                    <h3>July</h3>
                    <table class="table">
                        <tr>
                            <td><span class="birthday">1</span></td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                            <td>7</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>9</td>
                            <td>10</td>
                            <td>11</td>
                            <td>12</td>
                            <td>13</td>
                            <td>14</td>
                        </tr>
                        <tr>
                            <td><span class="birthday">15</span></td>
                            <td>16</td>
                            <td>17</td>
                            <td><span class="birthday">18</span></td>
                            <td>19</td>
                            <td>20</td>
                            <td>21</td>
                        </tr>
                        <tr>
                            <td>22</td>
                            <td>23</td>
                            <td>24</td>
                            <td>25</td>
                            <td>26</td>
                            <td>27</td>
                            <td>28</td>
                        </tr>
                        <tr>
                            <td>29</td>
                            <td>30</td>
                            <td>31</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>                                                                                                 
                    </table>
                    <ul>
                        <li>1 - Harukawa Sora</li>
                        <li>15 - Shino Hajime</li>
                        <li>18 - Ogami Koga</li>
                    </ul>                    
                </div>  
                <div class="col-md-3">
                    <h3>August</h3>
                    <table class="table">
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                            <td><span class="birthday">7</span></td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>9</td>
                            <td>10</td>
                            <td>11</td>
                            <td>12</td>
                            <td>13</td>
                            <td>14</td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>16</td>
                            <td>17</td>
                            <td>18</td>
                            <td>19</td>
                            <td>20</td>
                            <td>21</td>
                        </tr>
                        <tr>
                            <td>22</td>
                            <td>23</td>
                            <td>24</td>
                            <td>25</td>
                            <td>26</td>
                            <td>27</td>
                            <td>28</td>
                        </tr>
                        <tr>
                            <td><span class="birthday">29</span></td>
                            <td><span class="birthday">30</span></td>
                            <td>31</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>                                                                                                 
                    </table>
                    <ul>
                        <li>7 - Aoba Tsumugi</li>
                        <li>29 - Otogari Adonis</li>
                        <li>29 - Takamine Midori</li>
                        <li>30 - Shinkai Kanata</li>
                    </ul>                                    
                </div>                                                         
            </div> <!-- end calendar row of 4 --> 
            <div class="row">
                <div class="col-md-3">
                    <h3>September</h3>
                    <table class="table">
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td><span class="birthday">6</span></td>
                            <td><span class="birthday">7</span></td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>9</td>
                            <td>10</td>
                            <td>11</td>
                            <td>12</td>
                            <td>13</td>
                            <td>14</td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>16</td>
                            <td>17</td>
                            <td><span class="birthday">18</span></td>
                            <td>19</td>
                            <td>20</td>
                            <td>21</td>
                        </tr>
                        <tr>
                            <td><span class="birthday">22</span></td>
                            <td>23</td>
                            <td>24</td>
                            <td>25</td>
                            <td>26</td>
                            <td>27</td>
                            <td>28</td>
                        </tr>
                        <tr>
                            <td>29</td>
                            <td>30</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>                                                                                                 
                    </table>
                    <ul>
                        <li>6 - Hasumi Keito</li>
                        <li>7 - Tenma Mitsuru</li>
                        <li>18 - Morisawa Chiaki</li>
                        <li>22 - Sakuma Ritsu</li>
                    </ul>                                    
                </div>
                <div class="col-md-3">
                    <h3>October</h3>
                    <table class="table">
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                            <td>7</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>9</td>
                            <td>10</td>
                            <td>11</td>
                            <td>12</td>
                            <td>13</td>
                            <td>14</td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>16</td>
                            <td>17</td>
                            <td><span class="birthday">18</span></td>
                            <td>19</td>
                            <td>20</td>
                            <td>21</td>
                        </tr>
                        <tr>
                            <td>22</td>
                            <td>23</td>
                            <td>24</td>
                            <td>25</td>
                            <td>26</td>
                            <td>27</td>
                            <td>28</td>
                        </tr>
                        <tr>
                            <td>29</td>
                            <td><span class="birthday">30</span></td>
                            <td>31</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>                                                                                                 
                    </table>
                    <ul>
                        <li>18 - Fushimi Yuzuru</li>
                        <li>30 - Itsuki Shu</li>
                    </ul>                                    
                </div>
                <div class="col-md-3">
                    <h3>November</h3>
                    <table class="table">
                        <tr>
                            <td>1</td>
                            <td><span class="birthday">2</span></td>
                            <td><span class="birthday">3</span></td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                            <td>7</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>9</td>
                            <td>10</td>
                            <td>11</td>
                            <td>12</td>
                            <td>13</td>
                            <td>14</td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>16</td>
                            <td>17</td>
                            <td>18</td>
                            <td>19</td>
                            <td>20</td>
                            <td>21</td>
                        </tr>
                        <tr>
                            <td>22</td>
                            <td>23</td>
                            <td>24</td>
                            <td>25</td>
                            <td>26</td>
                            <td>27</td>
                            <td>28</td>
                        </tr>
                        <tr>
                            <td>29</td>
                            <td>30</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>                                                                                                 
                    </table>
                    <ul>
                        <li>2 - Sakuma Rei</li>
                        <li>2 - Sena Izumi</li>
                        <li>3 - Hagaze Kaoru</li>
                    </ul>                                    
                </div>
                <div class="col-md-3">
                    <h3>December</h3>
                    <table class="table">
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                            <td>7</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>9</td>
                            <td>10</td>
                            <td><span class="birthday">11</span></td>
                            <td>12</td>
                            <td>13</td>
                            <td>14</td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>16</td>
                            <td><span class="birthday">17</span></td>
                            <td>18</td>
                            <td>19</td>
                            <td>20</td>
                            <td>21</td>
                        </tr>
                        <tr>
                            <td>22</td>
                            <td>23</td>
                            <td>24</td>
                            <td>25</td>
                            <td><span class="birthday">26</span></td>
                            <td>27</td>
                            <td>28</td>
                        </tr>
                        <tr>
                            <td>29</td>
                            <td>30</td>
                            <td>31</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>                                                                                                 
                    </table>
                    <ul>
                        <li>11 - Sagami Jin</li>
                        <li>17 - Hidaka Hokuto</li>
                        <li>26 - Kagehira Mika</li>
                    </ul>                                    
                </div>                                                                             
            </div> <!-- end calendar row of 4 -->                       
        </div> <!-- end 12 div -->
    </div> <!-- end first row -->
</div> <!-- end container -->
@endsection
