<?php
use yii\helpers\Html;
?>

<div class="calendar-container">
    <div class="calendar-header text-center mb-5">
        <div class="uth-logo mb-4">
            <img src="<?= Yii::getAlias('@web') ?>/uploads/imagenes/logo.png" alt="UTH Logo" class="img-fluid" style="max-height: 150px;">
        </div>
        <h1 class="calendar-title">CALENDARIO ESCOLAR 2024-2025</h1>
        <p class="university-name">Universidad Tecnológica de Huejotzingo</p>
    </div>

    <div class="row">
        <div class="col-lg-9">
            <div class="calendar-grid">
                <!-- Septiembre 2024 -->
                <div class="month-table">
                    <div class="month-header">Septiembre 2024</div>
                    <table class="month-calendar">
                        <tr class="weekdays">
                            <td>D</td><td>L</td><td>M</td><td>M</td><td>J</td><td>V</td><td>S</td>
                        </tr>
                        <tr>
                            <td>1</td><td class="inicio-curso">2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td>
                        </tr>
                        <tr>
                            <td>8</td><td>9</td><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td>
                        </tr>
                        <tr>
                            <td>15</td><td class="suspension">16</td><td>17</td><td>18</td><td>19</td><td>20</td><td>21</td>
                        </tr>
                        <tr>
                            <td>22</td><td>23</td><td>24</td><td>25</td><td>26</td><td>27</td><td>28</td>
                        </tr>
                        <tr>
                            <td>29</td><td>30</td><td></td><td></td><td></td><td></td><td></td>
                        </tr>
                    </table>
                </div>

                <!-- Octubre 2024 -->
                <div class="month-table">
                    <div class="month-header">Octubre 2024</div>
                    <table class="month-calendar">
                        <tr class="weekdays">
                            <td>D</td><td>L</td><td>M</td><td>M</td><td>J</td><td>V</td><td>S</td>
                        </tr>
                        <tr>
                            <td></td><td class="suspension">1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td>
                        </tr>
                        <tr>
                            <td>7</td><td>8</td><td>9</td><td>10</td><td>11</td><td class="festivo">12</td><td>13</td>
                        </tr>
                        <tr>
                            <td>14</td><td>15</td><td>16</td><td>17</td><td>18</td><td>19</td><td>20</td>
                        </tr>
                        <tr>
                            <td>21</td><td>22</td><td>23</td><td>24</td><td>25</td><td>26</td><td>27</td>
                        </tr>
                        <tr>
                            <td>28</td><td>29</td><td>30</td><td>31</td><td></td><td></td><td></td>
                        </tr>
                    </table>
                </div>

                <!-- Noviembre 2024 -->
                <div class="month-table">
                    <div class="month-header">Noviembre 2024</div>
                    <table class="month-calendar">
                        <tr class="weekdays">
                            <td>D</td><td>L</td><td>M</td><td>M</td><td>J</td><td>V</td><td>S</td>
                        </tr>
                        <tr>
                            <td></td><td></td><td></td><td></td><td></td><td class="suspension">1</td><td class="suspension">2</td>
                        </tr>
                        <tr>
                            <td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td>
                        </tr>
                        <tr>
                            <td>10</td><td>11</td><td>12</td><td>13</td><td>14</td><td>15</td><td>16</td>
                        </tr>
                        <tr>
                            <td>17</td><td class="suspension">18</td><td>19</td><td class="festivo">20</td><td>21</td><td>22</td><td>23</td>
                        </tr>
                        <tr>
                            <td>24</td><td>25</td><td>26</td><td>27</td><td>28</td><td>29</td><td>30</td>
                        </tr>
                    </table>
                </div>

                <!-- Diciembre 2024 -->
                <div class="month-table">
                    <div class="month-header">Diciembre 2024</div>
                    <table class="month-calendar">
                        <tr class="weekdays">
                            <td>D</td><td>L</td><td>M</td><td>M</td><td>J</td><td>V</td><td>S</td>
                        </tr>
                        <tr>
                            <td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td>
                        </tr>
                        <tr>
                            <td>8</td><td class="suspension">9</td><td>10</td><td>11</td><td class="festivo">12</td><td>13</td><td>14</td>
                        </tr>
                        <tr>
                            <td>15</td><td>16</td><td>17</td><td>18</td><td>19</td><td>20</td><td>21</td>
                        </tr>
                        <tr>
                            <td>22</td><td>23</td><td>24</td><td class="festivo">25</td><td>26</td><td>27</td><td>28</td>
                        </tr>
                        <tr>
                            <td>29</td><td>30</td><td>31</td><td></td><td></td><td></td><td></td>
                        </tr>
                    </table>
                </div>

                <!-- Enero 2025 -->
                <div class="month-table">
                    <div class="month-header">Enero 2025</div>
                    <table class="month-calendar">
                        <tr class="weekdays">
                            <td>D</td><td>L</td><td>M</td><td>M</td><td>J</td><td>V</td><td>S</td>
                        </tr>
                        <tr>
                            <td></td><td></td><td></td><td>1</td><td>2</td><td>3</td><td>4</td>
                        </tr>
                        <tr>
                            <td>5</td><td class="suspension">6</td><td class="suspension">7</td><td>8</td><td>9</td><td>10</td><td>11</td>
                        </tr>
                        <tr>
                            <td>12</td><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td>
                        </tr>
                        <tr>
                            <td>19</td><td class="inicio-curso">20</td><td>21</td><td>22</td><td>23</td><td>24</td><td>25</td>
                        </tr>
                        <tr>
                            <td>26</td><td>27</td><td>28</td><td>29</td><td>30</td><td>31</td><td></td>
                        </tr>
                    </table>
                </div>

                <!-- Febrero 2025 -->
                <div class="month-table">
                    <div class="month-header">Febrero 2025</div>
                    <table class="month-calendar">
                        <tr class="weekdays">
                            <td>D</td><td>L</td><td>M</td><td>M</td><td>J</td><td>V</td><td>S</td>
                        </tr>
                        <tr>
                            <td></td><td></td><td></td><td></td><td></td><td></td><td>1</td>
                        </tr>
                        <tr>
                            <td>2</td><td class="suspension">3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td>
                        </tr>
                        <tr>
                            <td>9</td><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td><td>15</td>
                        </tr>
                        <tr>
                            <td>16</td><td>17</td><td>18</td><td>19</td><td>20</td><td>21</td><td>22</td>
                        </tr>
                        <tr>
                            <td>23</td><td class="festivo">24</td><td>25</td><td>26</td><td>27</td><td>28</td><td></td>
                        </tr>
                    </table>
                </div>

                <!-- Marzo 2025 -->
                <div class="month-table">
                    <div class="month-header">Marzo 2025</div>
                    <table class="month-calendar">
                        <tr class="weekdays">
                            <td>D</td><td>L</td><td>M</td><td>M</td><td>J</td><td>V</td><td>S</td>
                        </tr>
                        <tr>
                            <td></td><td></td><td></td><td></td><td></td><td></td><td>1</td>
                        </tr>
                        <tr>
                            <td>2</td><td class="suspension">3</td><td class="suspension">4</td><td>5</td><td>6</td><td>7</td><td>8</td>
                        </tr>
                        <tr>
                            <td>9</td><td>10</td><td>11</td><td>12</td><td class="evaluacion">13</td><td>14</td><td>15</td>
                        </tr>
                        <tr>
                            <td>16</td><td class="inscripciones">17</td><td>18</td><td>19</td><td>20</td><td class="festivo">21</td><td>22</td>
                        </tr>
                        <tr>
                            <td>23</td><td>24</td><td>25</td><td>26</td><td>27</td><td class="suspension">28</td><td>29</td>
                        </tr>
                        <tr>
                            <td>30</td><td>31</td><td></td><td></td><td></td><td></td><td></td>
                        </tr>
                    </table>
                </div>

                <!-- Abril 2025 -->
                <div class="month-table">
                    <div class="month-header">Abril 2025</div>
                    <table class="month-calendar">
                        <tr class="weekdays">
                            <td>D</td><td>L</td><td>M</td><td>M</td><td>J</td><td>V</td><td>S</td>
                        </tr>
                        <tr>
                            <td></td><td></td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td>
                        </tr>
                        <tr>
                            <td>6</td><td class="reinscripciones">7</td><td>8</td><td>9</td><td>10</td><td>11</td><td>12</td>
                        </tr>
                        <tr>
                            <td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td><td>19</td>
                        </tr>
                        <tr>
                            <td>20</td><td>21</td><td>22</td><td>23</td><td>24</td><td class="fin-cuatrimestre">25</td><td>26</td>
                        </tr>
                        <tr>
                            <td>27</td><td>28</td><td>29</td><td class="evaluacion">30</td><td></td><td></td><td></td>
                        </tr>
                    </table>
                </div>

                <!-- Mayo 2025 -->
                <div class="month-table">
                    <div class="month-header">Mayo 2025</div>
                    <table class="month-calendar">
                        <tr class="weekdays">
                            <td>D</td><td>L</td><td>M</td><td>M</td><td>J</td><td>V</td><td>S</td>
                        </tr>
                        <tr>
                            <td></td><td></td><td></td><td></td><td class="suspension">1</td><td>2</td><td>3</td>
                        </tr>
                        <tr>
                            <td>4</td><td class="suspension">5</td><td class="suspension">6</td><td>7</td><td>8</td><td>9</td><td class="suspension">10</td>
                        </tr>
                        <tr>
                            <td>11</td><td>12</td><td>13</td><td>14</td><td class="suspension">15</td><td>16</td><td>17</td>
                        </tr>
                        <tr>
                            <td>18</td><td>19</td><td>20</td><td>21</td><td>22</td><td>23</td><td>24</td>
                        </tr>
                        <tr>
                            <td>25</td><td>26</td><td>27</td><td>28</td><td>29</td><td>30</td><td>31</td>
                        </tr>
                    </table>
                </div>

                <!-- Junio 2025 -->
                <div class="month-table">
                    <div class="month-header">Junio 2025</div>
                    <table class="month-calendar">
                        <tr class="weekdays">
                            <td>D</td><td>L</td><td>M</td><td>M</td><td>J</td><td>V</td><td>S</td>
                        </tr>
                        <tr>
                            <td>1</td><td class="graduacion">2</td><td>3</td><td>4</td><td class="graduacion">5</td><td>6</td><td>7</td>
                        </tr>
                        <tr>
                            <td>8</td><td>9</td><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td>
                        </tr>
                        <tr>
                            <td>15</td><td>16</td><td>17</td><td>18</td><td class="suspension">19</td><td>20</td><td>21</td>
                        </tr>
                        <tr>
                            <td>22</td><td>23</td><td>24</td><td>25</td><td class="suspension">26</td><td>27</td><td>28</td>
                        </tr>
                        <tr>
                            <td>29</td><td>30</td><td></td><td></td><td></td><td></td><td></td>
                        </tr>
                    </table>
                </div>

                <!-- Julio 2025 -->
                <div class="month-table">
                    <div class="month-header">Julio 2025</div>
                    <table class="month-calendar">
                        <tr class="weekdays">
                            <td>D</td><td>L</td><td>M</td><td>M</td><td>J</td><td>V</td><td>S</td>
                        </tr>
                        <tr>
                            <td></td><td></td><td>1</td><td>2</td><td class="graduacion">3</td><td class="graduacion">4</td><td>5</td>
                        </tr>
                        <tr>
                            <td>6</td><td>7</td><td>8</td><td>9</td><td>10</td><td>11</td><td>12</td>
                        </tr>
                        <tr>
                            <td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td><td>19</td>
                        </tr>
                        <tr>
                            <td>20</td><td>21</td><td>22</td><td>23</td><td>24</td><td>25</td><td>26</td>
                        </tr>
                        <tr>
                            <td class="vacaciones">27</td><td>28</td><td>29</td><td>30</td><td>31</td><td></td><td></td>
                        </tr>
                    </table>
                </div>

                <!-- Agosto 2025 -->
                <div class="month-table">
                    <div class="month-header">Agosto 2025</div>
                    <table class="month-calendar">
                        <tr class="weekdays">
                            <td>D</td><td>L</td><td>M</td><td>M</td><td>J</td><td>V</td><td>S</td>
                        </tr>
                        <tr>
                            <td></td><td></td><td></td><td></td><td></td><td>1</td><td>2</td>
                        </tr>
                        <tr>
                            <td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td class="suspension">8</td><td>9</td>
                        </tr>
                        <tr>
                            <td>10</td><td class="suspension">11</td><td>12</td><td>13</td><td>14</td><td>15</td><td>16</td>
                        </tr>
                        <tr>
                            <td>17</td><td class="propedeutico">18</td><td class="propedeutico">19</td><td>20</td><td>21</td><td>22</td><td>23</td>
                        </tr>
                        <tr>
                            <td>24</td><td>25</td><td>26</td><td class="docente">27</td><td class="docente">28</td><td class="docente">29</td><td>30</td>
                        </tr>
                        <tr>
                            <td>31</td><td></td><td></td><td></td><td></td><td></td><td></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="legend-container">
                <h5>LEYENDA</h5>
                <div class="legend-items">
                    <div class="legend-item">
                        <span class="legend-dot inicio-curso"></span>
                        <span>Inicio de curso</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-dot suspension"></span>
                        <span>Suspensión de labores</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-dot vacaciones"></span>
                        <span>Vacaciones</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-dot evaluacion"></span>
                        <span>Evaluación diagnóstica</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-dot reinscripciones"></span>
                        <span>Reinscripciones</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-dot graduacion"></span>
                        <span>Ceremonias de graduación</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-dot propedeutico"></span>
                        <span>Curso propedéutico</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-dot docente"></span>
                        <span>Integración y desarrollo docente</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.calendar-container {
    background: #ffffff;
    padding: 2rem;
    font-family: Arial, sans-serif;
}

.calendar-title {
    font-size: 2.5rem;
    font-weight: bold;
    color: #00a86b;
    margin: 0;
    letter-spacing: 2px;
}

.university-name {
    color: #666;
    font-size: 1.1rem;
    margin: 0.5rem 0 0 0;
}

.uth-logo {
    text-align: center;
}

.calendar-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem;
    margin-bottom: 2rem;
}

.month-table {
    border: 1px solid #ccc;
    background: white;
}

.month-header {
    background: #4a90a4;
    color: white;
    padding: 0.5rem;
    text-align: center;
    font-weight: bold;
    font-size: 0.9rem;
}

.month-calendar {
    width: 100%;
    border-collapse: collapse;
}

.month-calendar td {
    border: 1px solid #ddd;
    width: 14.28%;
    height: 30px;
    text-align: center;
    font-size: 0.8rem;
    vertical-align: middle;
}

.weekdays td {
    background: #f0f0f0;
    font-weight: bold;
    height: 25px;
}

/* Colores según la leyenda oficial */
.inicio-curso { background: #00a86b; color: white; }
.suspension { background: #2c3e50; color: white; }
.vacaciones { background: #f39c12; color: white; }
.festivo { background: #e74c3c; color: white; }
.evaluacion { background: #9b59b6; color: white; }
.reinscripciones { background: #3498db; color: white; }
.fin-cuatrimestre { background: #e67e22; color: white; }
.graduacion { background: #1abc9c; color: white; }
.propedeutico { background: #34495e; color: white; }
.docente { background: #16a085; color: white; }
.inscripciones { background: #27ae60; color: white; }

.legend-container {
    background: #f8f9fa;
    border: 1px solid #ddd;
    padding: 1.5rem;
    border-radius: 5px;
}

.legend-container h5 {
    color: #333;
    font-weight: bold;
    margin-bottom: 1rem;
    text-align: center;
}

.legend-item {
    display: flex;
    align-items: center;
    margin-bottom: 0.75rem;
    font-size: 0.9rem;
}

.legend-dot {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    margin-right: 0.75rem;
    flex-shrink: 0;
}

@media (max-width: 1200px) {
    .calendar-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 768px) {
    .calendar-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .calendar-title {
        font-size: 1.8rem;
    }
}

@media (max-width: 480px) {
    .calendar-grid {
        grid-template-columns: 1fr;
    }
}
</style>